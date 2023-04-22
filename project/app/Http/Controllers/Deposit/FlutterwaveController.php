<?php

namespace App\Http\Controllers\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FlutterwaveController extends Controller
{
    public $public_key;
    private $secret_key;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $paydata = $data->convertAutoData();
        $this->public_key = $paydata['public_key'];
        $this->secret_key = $paydata['secret_key'];
    }

    public function store(Request $request) {
        $curl = curl_init();

        $customer_email =  auth()->user()->email;
        $currency = $request->currency_code;
        $PBFPubKey = $this->public_key;
        $redirect_url = route('deposit.flutter.notify');
        $payment_plan = "";

        $settings = Generalsetting::first();
        $item_name = $settings->title." Deposit";
        $item_number = Str::random(12);
        $txref = $item_number;
        $item_amount = $request->amount;
       
        $deposit = new Deposit();
        $deposit['user_id'] = auth()->user()->id;
        $deposit['currency_id'] = $request->currency_id;
        $deposit['amount'] = $request->amount;
        $deposit['method'] = $request->method;
        $deposit['deposit_number'] = $item_number;
        $deposit['status'] = "pending";

        $deposit->save();

        Session::put('deposit_number',$item_number);
        Session::put('deposit_data',$request->all());

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
              'amount' => $item_amount,
              'customer_email' => $customer_email,
              'currency' => $currency,
              'txref' => $txref,
              'PBFPubKey' => $PBFPubKey,
              'redirect_url' => $redirect_url,
              'payment_plan' => $payment_plan
            ]),
            CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
            ],
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          if($err){
            die('Curl returned error: ' . $err);
          }
          
          $transaction = json_decode($response);
          
          if(!$transaction->data && !$transaction->data->link){
            print_r('API returned error: ' . $transaction->message);
          }
          
          return redirect($transaction->data->link);

     }

     public function notify(Request $request) {

        $input = $request->all();
        $deposit_number = Session::get('deposit_number');
        $deposit_data = Session::get('deposit_data');
 
        $deposit = Deposit::where('deposit_number',$deposit_number)->where('status','pending')->first();

        if($request->cancelled == "true"){
          return redirect()->route('user.dashboard')->with('success',__('Payment Cancelled!'));
        }


        if (isset($input['txref'])) {
            $ref = $input['txref'];
            $query = array(
                "SECKEY" => $this->secret_key,
                "txref" => $ref
            );

            $data_string = json_encode($query);
              
            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
            $response = curl_exec($ch);
            curl_close($ch);
            $resp = json_decode($response, true);

            if ($resp['status'] == "success") {

              $paymentStatus = $resp['data']['status'];
              $chargeResponsecode = $resp['data']['chargecode'];

              if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($paymentStatus == "successful")) {
      
                  $order['txnid'] = $resp['data']['txid'];
                  $data['status'] = "complete";
                  $deposit->update($data);

                  $gs =  Generalsetting::findOrFail(1);

                  $currency = Currency::where('id',$deposit_data['currency_id'])->first();
                  $amountToAdd = $deposit_data['amount']/$currency->value;
      
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

                  if($gs->is_smtp == 1)
                  {
                      $data = [
                          'to' => $user->email,
                          'type' => "Deposit",
                          'cname' => $user->name,
                          'oamount' => $deposit_data['amount'],
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


                  return redirect()->route('user.deposit.create')->with('success','Deposit amount '.$deposit_data['amount'].' ('.$deposit_data['currency_code'].') successfully!');
              
              }
              else {
                return redirect()->route('user.deposit.create')->with('error','Something went wrong!');
              }

            }
        }
        else {
          return redirect()->route('user.deposit.create')->with('error','Something went wrong!');
          }

     }
}
