<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generalsetting extends Model
{
    protected $fillable = [
            'logo',
            'favicon',
            'loader',
            'admin_loader',
            'banner',
            'title',
            'header_email',
            'header_phone',
            'footer',
            'footer_logo',
            'copyright',
            'colors',
            'talkto',
            'map_key',
            'disqus',
            'is_maintain',
            'maintain_text',
            'day_of',
            'currency_format',
            'withdraw_fee',
            'withdraw_charge',
            'smtp_host',
            'smtp_port',
            'smtp_encryption',
            'smtp_user',
            'smtp_pass',
            'from_email',
            'from_name',
            'blockchain_check',
            'coinpayment_check',
            'service_image',
            'is_currency',
            'subscribe_success',
            'subscribe_error',
            'error_title',
            'error_text',
            'error_photo',
            'breadcumb_banner',
            'currency_code',
            'currency_sign',
            'withdraw_fee',
            'withdraw_charge',
            'affilate_banner',
            'affilate_charge',
            'secret_string',
            'gap_limit',
            'withdraw_status',
            'isWallet',
            'affilate_new_user',
            'affilate_user',
            'pm_account',
            'is_pm',
            'cc_api_key',
            'is_coin_base',
            'balance_transfer',
            'two_factor',
            'kyc',
            'menu',
            'transfer_fixed',
            'transfer_percentage',
            'transfer_min',
            'transfer_max',
            'fixed_request_charge',
            'percentage_request_charge',
            'minimum_request_money',
            'maximum_request_money',
            'twilio_account_sid',
            'twilio_auth_token',
            'twilio_default_number',
            'twilio_status',
            'nexmo_key',
            'nexmo_secret',
            'nexmo_default_number',
            'nexmo_status',
            'module_section',
            'phone_code',
            'latitude',
            'longitude'
        ];

    public $timestamps = false;

    public function sectionCheck($value)
    {
        $sections = explode(" , ", $this->module_section);
        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
    }

    public function dayOffCheck($value)
    {
        $sections = explode(" , ", $this->day_of);
        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
    }

    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if (file_exists(public_path().'/assets/images/'.$oldname)) {
                unlink(public_path().'/assets/images/'.$oldname);
            }
        }  
    }
}
