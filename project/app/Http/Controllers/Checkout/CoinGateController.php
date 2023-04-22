<?php

namespace App\Http\Controllers\Checkout;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Invest;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CoinGateController extends Controller
{
    public function coingetCallback(Request $request)
    {

        $trans_id = $request->order_id;
      
            if ($request->status == 'paid') {

                if (Invest::where('transaction_no',$trans_id)->where('payment_status','pending')->exists()){

                    $deposits = $request->receive_amount;
                    $order = Invest::where('transaction_no',$trans_id)->where('payment_status','pending')->first();
                    $data['coin_amount'] = $request->pay_amount;
                    $data['status'] = 1;
                    $data['payment_status'] = "completed";
                    $data['txnid'] = $request->token;
                    $order->update($data);

                    $user = User::whereId($order->user_id)->first();

                    $trans = new Transaction();
                    $trans->email = $user->email;
                    $trans->amount = $order->amount;
                    $trans->type = "Invest";
                    $trans->txnid = $order->transaction_no;
                    $trans->user_id = $order->user_id;
                    $trans->save();


                    $gs =  Generalsetting::findOrFail(1);

                    if($gs->is_affilate == 1)
                    {
                        $user = User::find($order->user_id);
                        if ($user->referral_id != 0)
                        {
                            $val = $order->invest / 100;
                            $sub = $val * $gs->affilate_charge;
                            $sub = round($sub,2);
                            $ref = User::find($user->referral_id);
                            if(isset($ref))
                            {
                                $ref->income += $sub;
                                $ref->update();

                                $trans = new Transaction;
                                $trans->email = $ref->email;
                                $trans->amount = $sub;
                                $trans->type = "Referral Bonus";
                                $trans->txnid = $order->order_number;
                                $trans->user_id = $ref->id;
                                $trans->save();
                            }
                        }
                    }

                    if($gs->is_smtp == 1)
                    {
                        $data = [
                            'to' => $order->customer_email,
                            'type' => "Invest",
                            'cname' => $order->customer_name,
                            'oamount' => $order->order_number,
                            'aname' => "",
                            'aemail' => "",
                            'wtitle' => "",
                        ];

                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($data);
                    }
                    else
                    {
                        $to = $order->customer_email;
                        $subject = " You have invested successfully.";
                        $msg = "Hello ".$order->customer_name."!\nYou have invested successfully.\nThank you.";
                        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                        mail($to,$subject,$msg,$headers);
                    }

                   // return "*ok*";

                }
            }

        
    }

    public function deposit(Request $request)
    {
        $generalsettings = Generalsetting::findOrFail(1);
        
        $blockinfo    = PaymentGateway::whereKeyword('coingate')->first();
        $blocksettings= $blockinfo->convertAutoData();

        if($request->amount > 0){

        $acc = Auth::user();
        $item_number = Str::random(12);

        $item_amount = $request->amount;
        $currency_code = $request->currency_code;

        $item_name = $generalsettings->title." Invest";

        $my_callback_url = route('checkout.coingate.notify');

        $return_url = route('user.dashboard');
        $cancel_url = route('checkout.paypal.cancel');


            \CoinGate\CoinGate::config(array(
                'environment'               => 'sandbox', // sandbox OR live
                'auth_token'                => $blocksettings['secret_string']
            ));


            $post_params = array(
                'order_id'          => $item_number,
                'price_amount'      => $item_amount,
                'price_currency'    => $currency_code,
                'receive_currency'  => $currency_code,
                'callback_url'      => $my_callback_url,
                'cancel_url'        => $cancel_url,
                'success_url'       => $return_url,
                'title'             => $item_name,
                'description'       => 'Invest'
            );

            $coinGate = \CoinGate\Merchant\Order::create($post_params);
        
            if ($coinGate)
            {
                $order = new Invest();

                $plan = Plan::whereId($request->plan_id)->first();
        
                $order['transaction_no'] = $item_number;
                $order['user_id'] = $request->user_id;
                $order['plan_id'] = $plan->id;
                $order['currency_id'] = $request->currency_id;
                $order['method'] = $request->method;
        
                if($request->currency_id){
                    $currencyValue = Currency::where('id',$request->currency_id)->first();
                    $order['amount'] = $request->amount/$currencyValue->value;
                    $profitAmount = ($request->amount * $plan->profit_percentage)/100;
                    $order['profit_amount'] = $profitAmount/$currencyValue->value;
                }
        
                if($plan->lifetime_return){
                    $order['lifetime_return'] = 1;
                }
        
                if($plan->captial_return){
                    $order['capital_back'] = 1;
                    $order['profit_repeat'] = 0;
                }

                $order['coin_amount'] = 1;
                $order['payment_status'] = "pending";
                $order['status'] = 0;
        
        
                $order['profit_time'] = Carbon::now()->addHours($plan->schedule_hour);
                $order->save();

                return redirect($coinGate->payment_url);

            }
            else
            {
                return redirect()->back()->with('unsuccess','Some Problem Occurrs! Please Try Again');
            }

        }
        return redirect()->back()->with('unsuccess','Please enter a valid amount.')->withInput();
    }
}
