<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function showLoginForm()
    {
      return view('user.login');
    }

    public function login(Request $request)
    {
        $rules = [
              'email'   => 'required|email',
              'password' => 'required'
            ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            if(Auth::guard('web')->user()->is_banned == 1)
            {
              Auth::guard('web')->logout();
              return response()->json(array('errors' => [ 0 => 'You are Banned From this system!' ]));   
            }

            if(Auth::guard('web')->user()->email_verified == 'No')
            {
              Auth::guard('web')->logout();
              return response()->json(array('errors' => [ 0 => 'Your Email is not Verified!' ]));   
            }

            if(session()->get('setredirectroute') != NULL){
              return response()->json(session()->get('setredirectroute'));
            }
            $gs = Generalsetting::first();
            $user = auth()->user();
            if($gs->two_factor && $user->twofa){
              return response()->json(route('user.otp'));
            }else{
                $user->update(['verified'=>1]);
                return response()->json(route('user.dashboard'));
            }
        }

        return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));     
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        session()->forget('setredirectroute');
        session()->forget('affilate');
        return redirect('/');
    }

    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';

        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }

}
