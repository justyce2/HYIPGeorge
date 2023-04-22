<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Illuminate\Support\Str;

class WithdrawMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = WithdrawMethod::orderBy('id','desc');
         
         return Datatables::of($datas)
                            ->editColumn('photo', function(WithdrawMethod $data) {
                                $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->editColumn('status', function(WithdrawMethod $data) {
                                return  $data->status == 1 ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-danger">deactived</span>';
                            })
                            ->addColumn('action', function(WithdrawMethod $data) {
                                
                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.withdraw.method.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.withdraw.method.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                            })
                            ->rawColumns(['photo','action','status'])
                            ->toJson();//--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.withdrawmethod.index');
    }

    public function create(){
        $data['currencies'] = Currency::orderBy('id','desc')->get();
        return view('admin.withdrawmethod.create',$data);
    }

    public function store(Request $request){
        $rules = [
            'name'=> 'required',
            'min_amount'=> 'required|gt:0',
            'max_amount'=> 'required|gt:0',
            'fixed'=> 'required|gt:0',
            'percentage'=> 'required|gt:0',
            'status'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $data = new WithdrawMethod();
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
           $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
           $file->move('assets/images',$name);
           $input['photo'] = $name;
        }

        $data->fill($input)->save();

        return response()->json('Data Added Successfully');
    }

    public function edit($id){
        $data['data'] = WithdrawMethod::findOrFail($id);
        $data['currencies'] = Currency::orderBy('id','desc')->get();

        return view('admin.withdrawmethod.edit',$data);
    }

    public function update(Request $request,$id){
        $rules = [
            'name'=> 'required',
            'min_amount'=> 'required|gt:0',
            'max_amount'=> 'required|gt:0',
            'fixed'=> 'required|gt:0',
            'percentage'=> 'required|gt:0',
            'status'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $data = WithdrawMethod::findOrFail($id);
        $input = $request->all();
        
        if ($file = $request->file('photo'))
        {
           $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
           $file->move('assets/images',$name);
           @unlink('assets/images/'.$data->photo);
           $input['photo'] = $name;
        }

        $data->update($input);

        return response()->json('Data Updated Successfully');
    }

    public function destroy($id){
        $data = WithdrawMethod::findOrFail($id);
        @unlink('assets/images/'.$data->photo);
        $data->delete();

        return response()->json('Data Deleted Successfully');
    }
}
