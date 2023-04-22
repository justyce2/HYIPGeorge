<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Str;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Repositories\OrderRepository;

class MollieController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){
        $support = [
            'AED',
            'AUD',
            'BGN',
            'BRL',
            'CAD',
            'CHF',
            'CZK',
            'DKK',
            'EUR',
            'GBP',
            'HKD',
            'HRK',
            'HUF',
            'ILS',
            'ISK',
            'JPY',
            'MXN',
            'MYR',
            'NOK',
            'NZD',
            'PHP',
            'PLN',
            'RON',
            'RUB',
            'SEK',
            'SGD',
            'THB',
            'TWD',
            'USD',
            'ZAR'
        ];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Or EUR Currency For Paypal.');
        }
   
        $item_amount = $request->amount;
        $input = $request->all();

        $item_name = "Deposit via Molly Payment";

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $request->currency_code,
                'value' => ''.sprintf('%0.2f', $item_amount).'',
            ],
            'description' => $item_name ,
            'redirectUrl' => route('checkout.molly.notify'),
            ]);

    
        Session::put('molly_data',$input);
        Session::put('payment_id',$payment->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }


    public function notify(Request $request){

        $input = Session::get('molly_data');
        $item_number = Str::random(4).time();
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
      
        if($payment->status == 'paid'){
            $addionalData = ['txnid'=>$item_number];
            $this->orderRepositorty->order($request,'running',$addionalData);

            Session::forget('molly_data');
            return redirect()->route('user.invest.history')->with('message','Invest successfully complete.');
        }
        else {
            return redirect()->route('user.invest.checkout')->with('warning','Something went wrong!');
        }

        return redirect()->route('user.invest.checkout')->with('warning','Something went wrong!');
    }
}
