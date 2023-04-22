<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\KycForm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KYCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function kycform()
    {
        $userType = 'user';
        $userForms = KycForm::where('user_type',$userType == 'user' ? 1 : 2)->get();
        return view('user.kyc.index',compact('userType','userForms'));
    }

    public function kyc(Request $request){
        $userType = 'user';
        $userForms = KycForm::where('user_type',$userType == 'user' ? 1 : 2)->get();

        $requireInformations = [];
        if($userForms){
            foreach($userForms as $key=>$value){
                if($value->type == 1){
                    $requireInformations['text'][$key] = strtolower(str_replace(' ', '_', $value->label));
                }
                elseif($value->type == 3){
                    $requireInformations['textarea'][$key] = strtolower(str_replace(' ', '_', $value->label));
                }else{
                    $requireInformations['file'][$key] = strtolower(str_replace(' ', '_', $value->label));
                }
            }
        }


        $details = [];
        foreach($requireInformations as $key=>$infos){
            foreach($infos as $index=>$info){
 
                if($request->has($info)){
                    if($request->hasFile($info)){
                        if ($file = $request->file($info))
                        {
                           $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                           $file->move('assets/images',$name);
                           $details[$info] = [$name,$key];
                        }
                    }else{
                        $details[$info] = [$request->$info,$key];
                    }
                }
            }
        }

        $user = auth()->user();
        if(!empty($details)){
            $user->kyc_info = json_encode($details,true);
        }
        $user->save();

        return redirect()->route('user.dashboard')->with('message','KYC submitted successfully');
    }
}
