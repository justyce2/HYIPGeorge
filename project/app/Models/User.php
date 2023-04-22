<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

   protected $fillable = [
       'name',
       'username',
       'photo',
       'zip', 
       'residency', 
       'city', 
       'address', 
       'phone', 
       'fax', 
       'email',
       'password',
       'verification_link',
       'affilate_code',
       'is_provider',
       'twofa',
       'go',
       'details',
       'kyc_status',
       'kyc_info',
       'kyc_reject_reason'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function balanceTransfers(){
        return $this->hasMany(BalanceTransfer::class);
    }

    public function invests(){
        return $this->hasMany(Invest::class);
    }

    public function deposits(){
        return $this->hasMany(Deposit::class);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }


    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction','user_id');
    }
}
