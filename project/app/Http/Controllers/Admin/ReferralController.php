<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $data['referrals'] = Referral::get();
        return view('admin.referral.index',$data);
    }

    public function store(Request $request){
        Referral::where('commission_type','invest')->delete();
        
        for($i=0; $i<count($request->level); $i++){
            $data = new Referral();
            $data->commission_type = 'invest';
            $data->level = $request->level[$i];
            $data->percent = $request->percent[$i];
            $data->save();
        }

        return back()->with('success', 'Referral Level Updated For Invest');
    }
}
