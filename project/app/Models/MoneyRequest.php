<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyRequest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transaction_no',
        'user_id',
        'receiver_id',
        'receiver_name',
        'cost',
        'amount',
        'status',
    ];
}
