<?php
namespace App\Repositories;

use App\Classes\GeniusMailer;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Invest;
use App\Models\Notification;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\ReferralBonus;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderRepository
{
    public $gs;
    public  $allusers = [];

    public function __construct()
    {
        $this->gs = Generalsetting::findOrFail(1);
    }

    public function order($request,$status,$addionalData){
        $order = new Invest();

        $plan = Plan::whereId($request->plan_id)->first();

        if(isset($addionalData['item_number'])){
            $order['transaction_no'] = $addionalData['item_number'];
        }
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

        if($status == 'running'){
            $order['payment_status'] = "completed";
            $order['status'] = 1;
        }else{
            $order['payment_status'] = "pending";
            $order['status'] = 0;
        }

        if(isset($addionalData['charge_id'])){
            $order['charge_id'] = $addionalData['charge_id'];
        }

        $order['profit_time'] = Carbon::now()->addHours($plan->schedule_hour);
        $order->save();

        if($status == 'running'){
            $this->callAfterOrder($request,$order);
        }
    }

    public function OrderFromSession($request,$status,$addionalData){
        $input = Session::get('input_data');
        $order = new Invest();

        $plan = Plan::whereId($input['plan_id'])->first();

        $order['transaction_no'] = $addionalData['txnid'];
        $order['user_id'] = $input['user_id'];
        $order['plan_id'] = $plan->id;
        $order['currency_id'] = $input['currency_id'];
        $order['method'] = $input['method'];

        if($input['currency_id']){
            $currencyValue = Currency::where('id',$input['currency_id'])->first();
            $order['amount'] = $input['amount']/$currencyValue->value;
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

        $order['status'] = 1;
        $order['payment_status'] = "completed";
        $order['profit_time'] = Carbon::now()->addHours($plan->schedule_hour);
        $order->save();

        if($status == 'complete'){
            $this->callAfterOrder($request,$order);
        }
    }

    public function callAfterOrder($request,$order){

        $this->createNotification($order);
        $this->createTransaction($order);
        $this->createUserNotification($request,$order);
        $this->sendMail($order);
        $this->refferalBonus($order);
    }

    public function createNotification($order){
        $notification = new Notification();
        $notification->order_id = $order->id;
        $notification->save();
    }

    public function createTransaction($order){
        $trans = new Transaction();
        $trans->email = auth()->user()->email;
        $trans->amount = $order->amount;
        $trans->type = "Invest";
        $trans->txnid = $order->transaction_no;
        $trans->user_id = $order->user_id;
        $trans->save();
    }

    public function createUserNotification($request,$order){
        $notf = new UserNotification();
        $notf->user_id = $order->user_id;
        $notf->order_id = $order->id;
        $notf->type = "Invest";
        $notf->save();
    }

    public function sendMail($order){
        $user = User::whereId($order->user_id)->first();
        if($this->gs->is_smtp == 1)
        {
        $data = [
            'to' => $user->email,
            'type' => "Invest",
            'cname' => $user->name,
            'oamount' => $order->amount,
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
           $subject = " You have invested successfully.";
           $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
           $headers = "From: ".$this->gs->from_name."<".$this->gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
    }

    public function refferalBonus($order){
        if($this->gs->is_affilate == 1){
            if(Session::has('affilate')){
                $this->referralUsers(Session::get('affilate'));

                $referral_ids = [];
                $referrals = Referral::where('commission_type','invest')->get();
                if(count($referrals)>0){
                    foreach($referrals as $key=>$data){
                        $referral_ids[] = $data->id;
                    }
                }
                if(count($this->allusers) >0){
                    $users = array_reverse($this->allusers);
                    foreach($users as $key=>$data){
                        $user = User::findOrFail($data);
                        $referral = Referral::findOrFail($referral_ids[$key]);
            
                        $referralAmount = ($order->invest * $referral->percent)/100;

                        $bonus = new ReferralBonus();
                        $bonus->from_user_id = auth()->id();
                        $bonus->to_user_id = $user->id;
                        $bonus->percentage = $referral->percent;
                        $bonus->level = $referral->level;
                        $bonus->amount = $referralAmount;
                        $bonus->type = 'invest';
                        $bonus->save();

                        $user->increment('income',$referralAmount);
                        $referralAmount = 0;
                    }
                }
            }
        }
    }

    public function referralUsers($id)
    {
        $referral = Referral::where('commission_type','invest')->get();

        for($i=1; $i<=count($referral); $i++){
            $user = User::findOrFail($id);
            $this->allusers[] = $user->id;
            
            if($user->referral_id){
                $id = $user->referral_id;
            }else{
                return false;
            }
        }
        return $this->allusers;
    }



}