<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_notf_count()
    {
        $user = Auth::user();  
        $data = UserNotification::where('user_id','=',$user->id)->where('is_read','=',0)->get()->count();
        return response()->json($data);            
    } 

    public function user_notf_clear()
    {
        $user = Auth::user(); 
        $data = UserNotification::where('user_id','=',$user->id);
        $data->delete();        
    } 

    public function user_notf_show()
    {
        $user = Auth::user(); 
        $datas = UserNotification::where('user_id','=',$user->id)->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('user.notification',compact('datas'));           
    } 
}
