<?php

namespace App\Http\Controllers\Deposit;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentGateway;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Classes\Instamojo;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Transaction;

class InstamojoController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $data = PaymentGateway::whereKeyword('instamojo')->first();
        $gs = Generalsetting::first();
        $total =  $request->amount;
        $paydata = $data->convertAutoData();

        if($request->currency_code != "INR")
        {
            return redirect()->back()->with('warning',__('Please Select INR Currency For This Payment.'));
        }

        $user = auth()->user();
        $order['item_name'] = $gs->title." Deposit";
        $order['item_number'] = Str::random(12);
        $order['item_amount'] = $total;

        $cancel_url = route('deposit.paypal.cancel');
        $notify_url = route('deposit.instamojo.notify');

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
                "email" => $user->email,
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
        $input = Session::get('input_data');
        $order_data = Session::get('order_data');

        $input_data = $request->all();
        $user = auth()->user();

        $deposit = new Deposit();
 
        $payment_id = Session::get('order_payment_id');
        if($input_data['payment_status'] == 'Failed'){
            return redirect()->back()->with('unsuccess','Something Went wrong!');
        }

        if ($input_data['payment_request_id'] == $payment_id) {

            $currency = Currency::where('id',$input['currency_id'])->first();
            $amountToAdd = $input['amount']/$currency->value;

            $deposit['deposit_number'] = $order_data['item_number'];
            $deposit['user_id'] = auth()->user()->id;
            $deposit['currency_id'] = $input['currency_id'];
            $deposit['amount'] = $amountToAdd;
            $deposit['method'] = $input['method'];
            $deposit['txnid'] = $payment_id;
            $deposit['status'] = "complete";

            $deposit->save();


            $gs =  Generalsetting::findOrFail(1);

            $user = auth()->user();
            $user->balance += $amountToAdd;
            $user->save();

            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $amountToAdd;
            $trans->type = "Deposit";
            $trans->profit = "plus";
            $trans->txnid = $order_data['item_number'];
            $trans->user_id = $user->id;
            $trans->save();


            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'type' => "Deposit",
                    'cname' => $user->name,
                    'oamount' => $input['amount'],
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendAutoMail($data);            
            }
            else
            {
               $to = $user->email;
               $subject = " You have deposited successfully.";
               $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);            
            }

            return redirect()->route('user.deposit.create')->with('success','Deposit amount '.$input['amount'].' ('.$input['currency_code'].') successfully!');

        }
        return redirect()->route('user.deposit.create')->with('unsuccess','Something Went wrong!');
    }
}
