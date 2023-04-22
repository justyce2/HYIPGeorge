<?php

namespace App\Http\Controllers\Deposit;

use App\Http\Controllers\Controller;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{
    public function store(Request $request){
        $settings = Generalsetting::find(1);
        
        $authorizeinfo    = PaymentGateway::whereKeyword('authorize.net')->first();
        $authorizesettings= $authorizeinfo->convertAutoData();

        $item_name = $settings->title." Deposit";
        $item_number = Str::random(4).time();
        $item_amount = $request->amount;
        
     
        $validator = Validator::make($request->all(),[
            'cardNumber' => 'required',
            'cardCVC' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->passes()) {
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName($authorizesettings['login_id']);
            $merchantAuthentication->setTransactionKey($authorizesettings['txn_key']);

            $refId = 'ref' . time();

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber(str_replace(' ','',$request->cardNumber));
            $year = $request->year;
            $month = $request->month;
            $creditCard->setExpirationDate($year.'-'.$month);
            $creditCard->setCardCode($request->cardCVC);

            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
        
            $orderr = new AnetAPI\OrderType();
            $orderr->setInvoiceNumber($item_number);
            $orderr->setDescription($item_name);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction"); 
            $transactionRequestType->setAmount($item_amount);
            $transactionRequestType->setOrder($orderr);
            $transactionRequestType->setPayment($paymentOne);

            $requestt = new AnetAPI\CreateTransactionRequest();
            $requestt->setMerchantAuthentication($merchantAuthentication);
            $requestt->setRefId($refId);
            $requestt->setTransactionRequest($transactionRequestType);
        

            $controller = new AnetController\CreateTransactionController($requestt);
            if($authorizesettings['sandbox_check'] == 1){
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            else {
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);                
            }

        
            if ($response != null) {
                if ($response->getMessages()->getResultCode() == "Ok") {
                    $tresponse = $response->getTransactionResponse();
                
                    if ($tresponse != null && $tresponse->getMessages() != null) {
                        $deposit = new Deposit();
                        $deposit['deposit_number'] = Str::random(12);
                        $deposit['user_id'] = auth()->user()->id;
                        $deposit['currency_id'] = $request->currency_id;
                        $deposit['amount'] = $request->amount;
                        $deposit['method'] = $request->method;
                        $deposit['status'] = "complete";
    
                        $deposit->save();


                        $gs =  Generalsetting::findOrFail(1);
                        $user = auth()->user();

                        $user->balance += $request->amount;
                        $user->save();

                        $trans = new Transaction();
                        $trans->email = $user->email;
                        $trans->amount = $request->amount;
                        $trans->type = "Deposit";
                        $trans->profit = "plus";
                        $trans->txnid = $deposit->deposit_number;
                        $trans->user_id = $user->id;
                        $trans->save();
            
                        if($gs->is_smtp == 1)
                        {
                            $data = [
                                'to' => $user->email,
                                'type' => "Deposti",
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
    

                        return redirect()->route('user.deposit.create')->with('success','Deposit amount '.$request->amount.' ('.$request->currency_code.') successfully!');

                    } else {
                        return redirect()->route('user.deposit.create')->with('unsuccess', 'Payment Failed.');
                    }
                } else {
                    return redirect()->route('user.deposit.create')->with('unsuccess', 'Payment Failed.');
                }      
            } else {
                return redirect()->route('user.deposit.create')->with('unsuccess', 'Payment Failed.');
            }

        }
        return redirect()->route('user.deposit.create')->with('unsuccess', 'Invalid Payment Details.');
    }
}
