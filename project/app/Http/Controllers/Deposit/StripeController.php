<?php

namespace App\Http\Controllers\Deposit;

use App\Classes\GeniusMailer;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Error\Card;
use Carbon\Carbon;
use Input;
use Redirect;
use URL;
use Validator;
use Config;

class StripeController extends Controller
{
    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('Stripe')->first();
        $paydata = $data->convertAutoData();

        Config::set('services.stripe.key', $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);
    }

    public function store(Request $request){
        $settings = Generalsetting::findOrFail(1);
        $deposit = new Deposit();
        $item_name = $settings->title." Deposit";
        $item_number = Str::random(4).time();
        $item_amount = $request->amount;
        
        $support = ['USD'];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Currency For Stripe.');
        }
        $user = auth()->user();

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('error','Token Problem With Your Token.');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $request->currency_code,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $currency = Currency::where('id',$request->currency_id)->first();
                    $amountToAdd = $request->amount/$currency->value;

                    $deposit['deposit_number'] = Str::random(12);
                    $deposit['user_id'] = auth()->id();
                    $deposit['currency_id'] = $request->currency_id;
                    $deposit['amount'] = $amountToAdd;
                    $deposit['method'] = $request->method;
                    $deposit['txnid'] = $charge['balance_transaction'];
                    $deposit['charge_id'] = $charge['id'];
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
                    $trans->txnid = $deposit->deposit_number;
                    $trans->user_id = $user->id;
                    $trans->save();


                    if($gs->is_smtp == 1)
                    {
                        $data = [
                            'to' => $user->email,
                            'type' => "Deposit",
                            'cname' => $user->name,
                            'oamount' => $item_amount,
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

                    return redirect()->route('user.deposit.create')->with('success','Deposit amount '.$request->amount.' (USD) successfully!');
                }
                
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
        return back()->with('unsuccess', 'Please Enter Valid Credit Card Informations.');
    }
}
