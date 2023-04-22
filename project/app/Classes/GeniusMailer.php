<?php
/**
 * Created by PhpStorm.
 * User: ShaOn
 * Date: 11/29/2018
 * Time: 12:49 AM
 */

namespace App\Classes;

use App\Models\EmailTemplate;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GeniusMailer
{
    public function __construct()
    {
        $this->email = DB::table('generalsettings')->first();
        Config::set('mail.port', $this->email->smtp_port);
        Config::set('mail.host', $this->email->smtp_host);
        Config::set('mail.username', $this->email->smtp_user);
        Config::set('mail.password', $this->email->smtp_pass);
        Config::set('mail.encryption', $this->email->smtp_encryption);
    }
    public function sendAutoMail(array $mailData)
    {
        $setup = Generalsetting::first();

        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        if($mailData['type'] == 'Invest'){
            $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
        }else{
            $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
            $body = preg_replace("/{order_number}/", $mailData['oamount'] ,$body);
            $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
            $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
            $body = preg_replace("/{website_title}/", $setup->title ,$body);
        }

        $data = [
            'email_body' => $body
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $temp->email_subject;

        try{
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        }
        catch (\Exception $e){
            //die("Not Sent!");
        }
    }

    public function sendCustomMail(array $mailData)
    {
        $setup = Generalsetting::first();

        $data = [
            'email_body' => $mailData['body']
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];

        try{
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        }
        catch (\Exception $e){
            // die($e);
        }
        return true;
    }

}