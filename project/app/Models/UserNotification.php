<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

    public static function countNotifications($id)
    {
        return UserNotification::where('user_id','=',$id)->where('is_read','=',0)->get()->count();
    }

}
