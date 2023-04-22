<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $fillable = [
        'name',
        'currency_id',
        'photo',
        'min_amount',
        'max_amount',
        'fixed',
        'percentage',
        'status',
    ];

    public function currency(){
        return $this->belongsTo(Currency::class);
    }
}
