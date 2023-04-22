<?php

namespace App\Models;
use Illuminate\{
    Database\Eloquent\Model
};


class PaymentGateway extends Model
{
    protected $fillable = ['title', 'details', 'subtitle', 'name', 'type', 'information','currency_id'];
    public $timestamps = false;

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency')->withDefault();
    }

    public static function scopeHasGateway($curr)
    {
        return PaymentGateway::where('currency_id', 'like', "%\"{$curr}\"%")->get();
    }

    public function convertAutoData(){
        return  json_decode($this->information,true);
    }

    public function getAutoDataText(){
        $text = $this->convertAutoData();
        return end($text);
    }

    public function showKeyword(){
        $data = $this->keyword == null ? 'other' : $this->keyword;
        return $data;
    }

}