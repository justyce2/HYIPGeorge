<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'receiver_id',
        'transaction_no',
        'cost',
        'amount',
        'final_amount',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

}
