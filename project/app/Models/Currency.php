<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'sign', 'value'];
    public $timestamps = false;

    public function wiretransfers(){
        return $this->hasMany(WireTransferBank::class);
    }

    public function methods(){
        return $this->hasMany(WithdrawMethod::class);
    }

    public function withdraws(){
        return $this->hasMany(WithdrawMethod::class);
    }
}
