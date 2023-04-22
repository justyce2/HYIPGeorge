<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function order()
    {
    	return $this->belongsTo('App\Models\Order')->withDefault();
    }

    public static function countOrder()
    {
        return Notification::where('order_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get()->count();
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault();
    }

    public static function countRegistration()
    {
        return Notification::where('user_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get()->count();
    }

    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation')->withDefault();
    }

    public static function countConversation()
    {
        return Notification::where('conversation_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get()->count();
    }
    
}
