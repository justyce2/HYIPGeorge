<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_no',
        'charge_id',
        'user_id',
        'plan_id',
        'currency_id',
        'method',
        'amount',
        'profit_amount',
        'profit',
        'lifetime_return',
        'profit_repeat',
        'capital_back',
        'payment_status',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'profit_time'
    ];

    public function plan(){
        return $this->belongsTo(Plan::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
