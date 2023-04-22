<?php

namespace App\Http\Controllers\User;

use App\Classes\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;

class OTPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showotpForm()
    {
      return view('user.otp');
    }

    public function otp(Request $request)
    {
        $request->validate([
          'otp' => 'required'
        ]);

        $user = auth()->user();
        $googleAuth = new GoogleAuthenticator();
        $otp =  $request->otp;

        $secret = $user->go;
        $oneCode = $googleAuth->getCode($secret);
        $userOtp = $otp;
        if ($oneCode == $userOtp) {
            $user->verified = 1;
            $user->save();
            return redirect()->route('user.dashboard');
        } else {
          return redirect()->back()->with('error','OTP not match!');
        }    
    }


}
