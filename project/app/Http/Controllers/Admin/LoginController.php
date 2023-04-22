<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }


    public function showLoginForm()
    {
      return view('admin.login');
    }

    public function login(Request $request)
    {
        //--- Validation Section
        $input = $request->all();
        $rules = [
                    'email'   => 'required|email',
                    'password' => 'required'
                ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {


                return response()->json(route('admin.dashboard'));
            
        }
        // if unsuccessful, then redirect back to the login with the form data
        $msg = array(
            'type' => 'warn',
            'message' => "Credentials Doesn\'t Match !"
        );
        return response()->json(array('errors' => $msg));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function showForgotForm()
    {
      return view('admin.forgot');
    }

    public function forgot(Request $request)
    {

      $gs = Generalsetting::findOrFail(1);
      $input =  $request->all();
      if (Admin::where('email', '=', $request->email)->count() > 0) {
      // user found
      $admin = Admin::where('email', '=', $request->email)->firstOrFail();
      $token = md5(time().$admin->name.$admin->email);

      $input['email_token'] = $token;
      $admin->update($input);

      $subject = "Reset Password Request";
      $msg = "Please click this link : ".'<a href="'.route('admin.change.token',$token).'">'.route('admin.change.token',$token).'</a>'.' to change your password.';
      if($gs->is_smtp == 1)
      {
          $data = [
                  'to' => $request->email,
                  'subject' => $subject,
                  'body' => $msg,
          ];

          $mailer = new GeniusMailer();
          $mailer->sendCustomMail($data);
      }
      else
      {
          $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
          mail($request->email,$subject,$msg,$headers);
      }
      return response()->json('Verification Link Sent Successfully!. Please Check your email.');
      }
      else{
      // user not found
      return response()->json(array('errors' => [ 0 => 'No Account Found With This Email.' ]));
      }
    }
}
