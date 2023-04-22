<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\BankPlan;
use App\Models\Notification;
use App\Models\ReferralBonus;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Str;
use Validator;
use Session;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm(){
        return view('user.register');
    }

    public function register(Request $request)
    {
        $value = session('captcha_string');
        if ($request->codes != $value){
            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
        }

        $rules = [
            'username' => 'required|alpha_dash|min:5|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|min:6',
            'password' => 'required|confirmed'
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $gs = Generalsetting::findOrFail(1);

        $user = new User;
        $input = $request->all(); 

        $input['password'] = bcrypt($request['password']);
        $token = md5(time().$request->name.$request->email);
        $input['verification_link'] = $token;
        $input['affilate_code'] = md5($request->name.$request->email);
        $user->fill($input)->save();

        if($gs->is_verification_email == 1)
        {
            $verificationLink = "<a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";
            $to = $request->email;
            $subject = 'Verify your email address.';
            $msg = "Dear Customer,<br> We noticed that you need to verify your email address.".$verificationLink;

            if($gs->is_smtp == 1)
            {

                $mail = new PHPMailer(true);
        
                try {
                    $mail->isSMTP();
                    $mail->Host       = $gs->smtp_host;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $gs->smtp_user;
                    $mail->Password   = $gs->smtp_pass;
                    if ($gs->smtp_encryption == 'ssl') {
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    } else {
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    }
                    $mail->Port       = $gs->smtp_port;
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom($gs->from_email, $gs->from_name);
                    $mail->addAddress($user->email, $user->name);
                    $mail->addReplyTo($gs->from_email, $gs->from_name);
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $msg;
                    $mail->send();
                } catch (Exception $e) {
    
                }
            }
            else
            {
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$msg,$headers);
            }
            return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
        }
        else {

            if (Session::has('affilate')) 
            {
                $referral = User::findOrFail(Session::get('affilate'));
                $user->referral_id = $referral->id;
                $user->update();
            }

            if($gs->is_affilate == 1){
                if(Session::has('affilate')){

                    $mainUser = User::findOrFail(Session::get('affilate'));
                    $mainUser->balance += $gs->affilate_user;
                    $mainUser->update();

                    $user->balance += $gs->affilate_new_user;
                    $user->update();

                    $bonus = new ReferralBonus();
                    $bonus->from_user_id = $user->id;
                    $bonus->to_user_id = $mainUser->id;
                    $bonus->amount = $gs->affilate_user;
                    $bonus->type = 'Register';
                    $bonus->save();

                    $mainUserTrans = new Transaction();
                    $mainUserTrans->email = $mainUser->email;
                    $mainUserTrans->amount = $gs->affilate_user;
                    $mainUserTrans->type = "Referral Bonus";
                    $mainUserTrans->profit = "plus";
                    $mainUserTrans->txnid = Str::random(12);
                    $mainUserTrans->user_id =$mainUser->id;
                    $mainUserTrans->save();

                    $newUserTrans = new Transaction();
                    $newUserTrans->email = $user->email;
                    $newUserTrans->amount = $gs->affilate_user;
                    $newUserTrans->type = "Referral Bonus";
                    $newUserTrans->profit = "plus";
                    $newUserTrans->txnid = Str::random(12);
                    $newUserTrans->user_id =$user->id;
                    $newUserTrans->save();
                }
            }

            $user->email_verified = 'Yes';
            $user->update();
            $notification = new Notification;
            $notification->user_id = $user->id;
            $notification->save();
            Auth::guard('web')->login($user); 

            return response()->json(1);
        }

    }

    public function token($token)
    {
            $gs = Generalsetting::findOrFail(1);
            if($gs->is_verification_email == 1)
            {       
                $user = User::where('verification_link','=',$token)->first();
                if(isset($user))
                {
                    $user->email_verified = 'Yes';
                    $user->update();

                            if (Session::has('affilate')) 
                            {
                                $referral = User::findOrFail(Session::get('affilate'));
                                $user->referral_id = $referral->id;
                                $user->update();
                            }

                            if($gs->is_affilate == 1 && Session::has('affilate')){
                                $mainUser = $referral;
                                $mainUser->balance += $gs->affilate_user;
                                $mainUser->update();
            
                                $user->balance += $gs->affilate_new_user;
                                $user->update();
                            }


                    $notification = new Notification;
                    $notification->user_id = $user->id;
                    $notification->save();
                    Auth::guard('web')->login($user); 
                    return redirect()->route('user.dashboard')->with('success','Email Verified Successfully');
                }
            }
            else {
                return redirect()->back();  
            }
    }
}
