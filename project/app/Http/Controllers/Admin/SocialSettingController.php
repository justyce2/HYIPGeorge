<?php

namespace App\Http\Controllers\Admin;

use App\Models\Socialsetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class SocialSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function socialupdate(Request $request)
    {

        $input = $request->all(); 
        $data = Socialsetting::findOrFail(1);   
        $data->update($input);
        
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends               

    }


    public function socialupdateall(Request $request)
    {

        $input = $request->all(); 
        $data = Socialsetting::findOrFail(1);   
        if ($request->f_status == ""){
            $input['f_status'] = 0;
        }
        if ($request->t_status == ""){
            $input['t_status'] = 0;
        }
        if ($request->g_status == ""){
            $input['g_status'] = 0;
        }
        if ($request->l_status == ""){
            $input['l_status'] = 0;
        }
        if ($request->d_status == ""){
            $input['d_status'] = 0;
        }
        $data->update($input);
        //--- Logic Section Ends
        
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends               

    }


    public function index()
    {
    	$data = Socialsetting::findOrFail(1);
        return view('admin.socialsetting.index',compact('data'));
    }

    public function facebook()
    {
    	$data = Socialsetting::findOrFail(1);
        return view('admin.socialsetting.facebook',compact('data'));
    }

    public function google()
    {
    	$data = Socialsetting::findOrFail(1);
        return view('admin.socialsetting.google',compact('data'));
    }


    public function facebookup($status)
    {
        $data = Socialsetting::findOrFail(1);
        $data->f_check = $status;
        $data->update();
    }

    public function googleup($status)
    {
        
        $data = Socialsetting::findOrFail(1);
        $data->g_check = $status;
        $data->update();
    }

}
