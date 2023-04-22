<?php

namespace App\Http\Controllers\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Transaction;
use Carbon\Carbon;
use Session;
use Auth;
use Str;

class MollieController extends Controller
{
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

        $input = $request->all();
        $item_amount = $request->amount;

        $item_name = "Deposit via Molly Payment";

      
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'USD',
                'value' => ''.sprintf('%0.2f', $item_amount).'',
            ],
            'description' => $item_name ,
            'redirectUrl' => route('deposit.molly.notify'),
            ]);

    
        Session::put('molly_data',$input);
        Session::put('payment_id',$payment->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }


    public function notify(Request $request){

        $input = Session::get('molly_data');
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
      
        if($payment->status == 'paid'){
            $currency = Currency::where('id',$input['currency_id'])->first();
            $amountToAdd = $input['amount']/$currency->value;

            $deposit = new Deposit();
            $deposit['deposit_number'] = Str::random(12);
            $deposit['user_id'] = auth()->id();
            $deposit['currency_id'] = $input['currency_id'];
            $deposit['amount'] = $amountToAdd;
            $deposit['method'] = $input['method'];
            $deposit['status'] = "complete";
            $deposit['txnid'] = $payment->id;
            $deposit->save();

            $user = auth()->user();
            $user->balance += $amountToAdd;
            $user->save();

            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $amountToAdd;
            $trans->type = "Deposit";
            $trans->profit = "plus";
            $trans->txnid = $deposit->deposit_number;
            $trans->user_id = $user->id;
            $trans->save();


            $gs =  Generalsetting::findOrFail(1);
            $user = auth()->user();

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
   
            Session::forget('molly_data');
            return redirect()->route('user.deposit.create')->with('success','Deposit amount ('.$input['amount'].') successfully!');
        }
        else {
            return redirect()->route('user.deposit.create')->with('warning','Something Went wrong!');
        }

        return redirect()->route('user.deposit.create')->with('warning','Something Went wrong!');
    }
}
