<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Classes\CoinPaymentsAPI;
use App\Models\Generalsetting;
use App\Models\Invest;
use App\Models\PaymentGateway;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CoinPaymentController extends Controller
{
    public function blockInvest()
    {
        return view('user.coinpay');
    }

    public function coinCallback(Request $request)
    {

        Session::put('check_txn',$request->all());
       
        $blockinfo    = PaymentGateway::whereKeyword('coinPayment')->first();
        $blocksettings= $blockinfo->convertAutoData();
        $real_secret  = $blocksettings['secret_string'];
        $trans_id = $request->custom;
        $status = $request->status;
        $amount2 = floatval($request->amount2);
        $currency2 = $request->currency2;

        $getSec = Input::get('secret');
        if ($real_secret == $getSec){

            if (Order::where('order_number',$trans_id)->exists()){

                $order = Order::where('order_number',$trans_id)->where('payment_status','pending')->first();
                if ($status >= 100 || $status == 2) {
                    if ($currency2 == "BTC" && $order->coin_amount <= $amount2) {
                   
                            $data['payment_status'] = "completed";
                            $order->update($data);
                            $notification = new Notification;
                            $notification->order_id = $order->id;
                            $notification->save();

                            $trans = new Transaction;
                            $trans->email = $order->customer_email;
                            $trans->amount = $order->invest;
                            $trans->type = "Invest";
                            $trans->txnid = $order->order_number;
                            $trans->user_id = $order->user_id;
                            $trans->save();

                            $notf = new UserNotification;
                            $notf->user_id = $order->user_id;
                            $notf->order_id = $order->id;
                            $notf->type = "Invest";
                            $notf->save();

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



                                
                        }
                    }

            }

        }
    }

    public function deposit(Request $request)
    {
        $generalsettings = Generalsetting::findOrFail(1);
        $blockinfo    = PaymentGateway::whereKeyword('coinPayment')->first();
        $blocksettings= $blockinfo->convertAutoData();

        if($request->amount > 0){

        $acc = Auth::user();
        $item_number = Str::random(12);
        $item_amount = $request->amount;
        $currency_code = $request->currency_code;
      
        $secret = $blocksettings['secret_string'];
        $coin_public = $blocksettings['coin_public_key'];
        $coin_private = $blocksettings['coin_private_key'];

        $my_callback_url = url('/').'/coinpay/notify?transx_id='.$item_number.'&secret='.$secret;

     
            $cps = new CoinPaymentsAPI();
            $cps->Setup($coin_private,$coin_public);

            $req = array(
                'amount' => 100,
                'currency1' => 'USD',
                'currency2' => 'LTCT',
                'buyer_email' => $acc->email,
                'item_name' => $generalsettings->title.' Invest.',
                'custom' => $item_number,
                'ipn_url' => $my_callback_url,
            );

            $result = $cps->CreateTransaction($req);

            if ($result['error'] == 'ok') {

                $qr_url = $result['result']['qrcode_url'];
                $sts_url = $result['result']['status_url'];
                $checkout_url = $result['result']['checkout_url'];

                $address = $result['result']['address'];

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



                session([
                    'address' => $address,
                    'amount' => $result['result']['amount'],
                    'currency_value' => $item_amount,
                    'currency_sign' => $request->currency_sign,
                    'accountnumber' => $acc->id,
                    'status_url' => $sts_url,
                    'qrcode_url' => $qr_url,
                    'checkout_url' => $checkout_url
                ]);

                return redirect()->route('checkout.coinpay.invest');

            } else {

                return redirect()->back()->with('unsuccess', $result['error'])->withInput();

            }

        }
        return redirect()->back()->with('unsuccess','Please enter a valid amount.')->withInput();
    }
}
