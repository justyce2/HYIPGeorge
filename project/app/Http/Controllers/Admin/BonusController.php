<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterBonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{
    public function index()
    {
      return view('admin.user.bonus');
    }

    public function update(Request $request){
        $rules = [
            'bonus' => 'required',
            'status'=>'required'
             ];

     $validator = Validator::make($request->all(), $rules);

     if ($validator->fails()) {
       return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
     }
     $bonus= RegisterBonus::first();
     $data = $request->all();
     $bonus->update($data);

    $msg = 'Bonus Updated Successfully.';
    return response()->json($msg);



    }
}
