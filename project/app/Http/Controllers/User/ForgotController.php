<?php

namespace App\Http\Controllers\User;

use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;

class ForgotController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest');
    }

    public function showForgotForm()
    {
      return view('user.forgot');
    }

    public function forgot(Request $request)
    {
      //dd('ok');
      $gs = Generalsetting::findOrFail(1);
      $input =  $request->all();

      if (User::where('email', '=', $request->email)->count() > 0) {
   
        $admin = User::where('email', '=', $request->email)->firstOrFail();
        $autopass = Str::random(8);
        $input['password'] = bcrypt($autopass);
        $admin->update($input);
        $subject = "Reset Password Request";
        $msg = "Your New Password is : ".$autopass;

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
        return back()->with('message','Your Password Reseted Successfully. Please Check your email for new Password.');
      }
      else{
        return back()->with('warning','No Account Found With This Email.');  
      }  
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
        $cap_length=6;
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
