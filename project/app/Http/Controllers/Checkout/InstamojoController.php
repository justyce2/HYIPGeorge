<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Support\Facades\Session;
use App\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Classes\Instamojo;
use App\Models\Currency;

class InstamojoController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $data = PaymentGateway::whereKeyword('instamojo')->first();
        $gs = Generalsetting::first();
        $total =  $request->amount;

        $currency = Currency::whereId($request->currency_id)->first();
        $amount =  $request->amount/$currency->value;

        $paydata = $data->convertAutoData();

        if($request->currency_code != "INR")
        {
            return redirect()->back()->with('unsuccess',__('Please Select INR Currency For This Payment.'));
        }

        $order['item_name'] = $gs->title." Order";
        $order['item_number'] = Str::random(4).time();
        $order['item_amount'] = $total;
        $cancel_url = route('checkout.instamojo.cancel');
        $notify_url = route('checkout.instamojo.notify');

        if($paydata['sandbox_check'] == 1){
            $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        }
        else {
            $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $order['item_name'],
                "amount" => $order['item_amount'],
                "send_email" => true,
                "email" => auth()->user()->email,
                "redirect_url" => $notify_url
            ));
            $redirect_url = $response['longurl'];

            Session::put('input_data',$input);
            Session::put('order_data',$order);
            Session::put('order_payment_id', $response['id']);

            return redirect($redirect_url);

        }
        catch (Exception $e) {
            return redirect($cancel_url)->with('unsuccess','Error: ' . $e->getMessage());
        }
    }

    public function notify(Request $request)
    {
        $input_data = $request->all();

        $payment_id = Session::get('order_payment_id');

        if($input_data['payment_status'] == 'Failed'){
            dd('here');
            return redirect()->route('front.checkout')->with('error','Something went wrong!');
        }

        if ($input_data['payment_request_id'] == $payment_id) {

            $addionalData = ['txnid'=>$payment_id];
            $this->orderRepositorty->OrderFromSession($request,'complete',$addionalData);

            return redirect()->route('user.invest.history')->with('message','Invest successfully complete.');

        }
        return redirect()->route('user.invest.checkout')->with('warning','Something went wrong!');
    }

    public function cancel(){
        return redirect()->route('user.invest.checkout')->with('warning','Something went wrong!');
    }
}
