<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralBonus;
use App\Models\User;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function referred(){
        $data['referreds'] = User::where('referral_id',auth()->id())->orderBy('id','desc')->paginate(20);
        return view('user.referral.index',$data);
    }
    
    public function commissions(){
        $data['commissions'] = ReferralBonus::where('to_user_id',auth()->id())->orderBy('id','desc')->paginate(20);
        return view('user.referral.commission',$data);
    }
}
