<?php

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\EmailTemplate;
use App\Models\Withdraw;

if(!function_exists('globalCurrency')){
    function globalCurrency(){
        $currency = Session::get('currency') ?  DB::table('currencies')->where('id','=',Session::get('currency'))->first() : DB::table('currencies')->where('is_default','=',1)->first();
        return $currency;
    }
  }

  if(!function_exists('showPrice')){
      function showPrice($price){
        $gs = Generalsetting::first();
        $currency = globalCurrency();
        
        $price = round(($price) * $currency->value,2);
        if($gs->currency_format == 0){
            return $currency->sign. $price;
        }
        else{
            return $price. $currency->sign;
        }
    }
  }

  if(!function_exists('rootPrice')){
    function rootPrice($price){
      $gs = Generalsetting::first();
      $currency = globalCurrency();
      $price = round(($price) * $currency->value,2);
      return $price;
  }
}

  
  if(!function_exists('convertedPrice')){
    function convertedPrice($price,$currency){
        $currency = Currency::whereId($currency)->first();
        $gs = Generalsetting::first();

        $price = round(($price) * $currency->value,2);
        if($gs->currency_format == 0){
            return $currency->sign. $price;
        }
        else{
            return $price. $currency->sign;
        }
    }
  }

  if(!function_exists('defaultCurr')){
    function defaultCurr(){
      return Currency::where('is_default','=',1)->first();
    }
  }

  if(!function_exists('baseCurrencyAmount')){
    function baseCurrencyAmount($amount){
        $currency = Currency::where('is_default','=',1)->first();
        return $amount/$currency->value;
      }
  }

  if(!function_exists('investCurrencyAmount')){
    function investCurrencyAmount($amount){
        $currency = globalCurrency();
        return round($amount/$currency->value,2);
      }
  }

  if(!function_exists('getWithdraws')){
    function getWithdraws(){
        return Withdraw::orderBy('id','desc')->limit(10)->get();
    }
  }

  if(!function_exists('getDeposits')){
    function getDeposits(){
        return Deposit::orderBy('id','desc')->limit(10)->get();
    }
  }

  if(!function_exists('getBrands')){
    function getBrands(){
        return Brand::orderBy('id','desc')->get();
    }
  }

  if(!function_exists('getAdmin')){
    function getAdmin(){
        return Admin::first();
    }
  }
    
  function email($data){
    
    $gs = Generalsetting::first();

        if ($gs->is_smtp != 1) {
            $headers = "From: $gs->sitename <$gs->email_from> \r\n";
            $headers .= "Reply-To: $gs->sitename <$gs->email_from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            mail($data['email'], $data['subject'], $data['message'], $headers);
        }
        else {
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
                $mail->addAddress($data['email'], $data['name']);
                $mail->addReplyTo($gs->from_email, $gs->from_name);
                $mail->isHTML(true);
                $mail->Subject = $data['subject'];
                $mail->Body    = $data['message'];
                $mail->send();
            } catch (Exception $e) {
                throw new Exception($e);
            }
        }
    }
