<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'currency_id',
        'txnid',
        'user_id',
        'method',
         'address',
        'reference', 
        'amount', 
        'fee',
        'details', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

}
