<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Invest;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use PayPal\{
    Api\Item,
    Api\Payer,
    Api\Amount,
    Api\Payment,
    Api\ItemList,
    Rest\ApiContext,
    Api\Transaction,
    Api\RedirectUrls,
    Api\PaymentExecution,
    Auth\OAuthTokenCredential
};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Repositories\OrderRepository;
use Illuminate\Support\Str;

class PaypalController extends Controller
{
    private $_api_context;
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $data = Paymentgateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();
        
        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $paydata['client_id'];
        $paypal_conf['secret'] = $paydata['client_secret'];
        $paypal_conf['settings']['mode'] = $paydata['sandbox_check'] == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){

        $cancel_url = route('checkout.paypal.cancel');
        $notify_url = route('checkout.paypal.notify');

        $gs = Generalsetting::findOrFail(1);
        $item_name = $gs->title." Invest";
        $item_number = Str::random(4).time();
        $item_amount = $request->amount;

        $support = ['USD','EUR'];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Or EUR Currency For Paypal.');
        }

        $addionalData = ['item_number'=>$item_number];
        $this->orderRepositorty->order($request,'pending',$addionalData);

        $currency = Currency::whereId($request->currency_id)->first();
        $amountToAdd = $request->amount/$currency->value;


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($item_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($amountToAdd);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($amountToAdd);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($item_name.' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url)
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            
            
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                return redirect()->back()->with('unsuccess',$ex->getMessage());
            }
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
           
            Session::put('paypal_data',$request->all());
            Session::put('paypal_payment_id', $payment->getId());
            Session::put('order_number',$item_number);

            if (isset($redirect_url)) {
                return Redirect::away($redirect_url);
            }


            return redirect()->back()->with('unsuccess','Unknown error occurred');

            if (isset($redirect_url)) {
                return Redirect::away($redirect_url);
            }
            return redirect()->back()->with('unsuccess','Unknown error occurred');

    }

    public function notify(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        if (empty( $request['PayerID']) || empty( $request['token'])) {
            return redirect()->back()->with('error', 'Payment Failed'); 
        } 

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request['PayerID']);

        $trx = Session::get('order_number');

        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);

            $order = Invest::where('transaction_no',$trx)->where('payment_status','pending')->first();
            $data['txnid'] = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
            $data['payment_status'] = "completed";
            $data['status'] = 1;
            $order->update($data);

            $this->orderRepositorty->callAfterOrder($request,$order);


            Session::forget('paypal_data');
            Session::forget('paypal_payment_id');
            Session::forget('order_number');

            return redirect()->route('user.invest.history')->with('message','Invest successfully complete.');
        }

    }

    public function cancel(){
        return redirect()->route('user.invest.checkout')->with('warning','Something went wrong!');
    }
}
