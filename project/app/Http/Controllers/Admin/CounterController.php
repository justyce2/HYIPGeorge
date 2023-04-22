<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Counter;
use Validator;
use Datatables;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Counter::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('count', function(Counter $data){
                                if($data->is_money == 1){
                                  $count = '$ '.$data->count;
                                }else{
                                  $count = $data->count;
                                }
                                return $count;
                            })
                            ->addColumn('action', function(Counter $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.counter.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.counter.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['count', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.counter.index');
    }

    public function create()
    {
        return view('admin.counter.create');
    }


    public function store(Request $request)
    {
        $rules = [
          'photo'  => 'required|mimes:jpeg,bmp,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Counter();
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
          $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
          $file->move('assets/images',$name);
          $input['photo'] = $name;
        }

        if($request->is_money){
          $input['is_money'] = 1;
        } 
        $data->fill($input)->save();
      
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.counter.index").'">View Counter Lists</a>';
        return response()->json($msg);         
    }

    public function edit($id)
    {
        $data = Counter::findOrFail($id);
        return view('admin.counter.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
      $rules = [
        'photo'  => 'mimes:jpeg,bmp,png,gif',
      ];

      $validator = Validator::make($request->all(), $rules);
        
      if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
      }

        $data = Counter::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
          $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
          $file->move('assets/images',$name);
          @unlink('assets/images'.$data->photo);
          $input['photo'] = $name;
        }

        if($request->is_money){
          $input['is_money'] = 1;
        }else{
          $input['is_money'] = 0;
        } 
        $data->update($input);
  
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.counter.index").'">View Counter Lists</a>';
        return response()->json($msg);                
    }


    public function destroy($id)
    {
        $data = Counter::findOrFail($id);
        $data->delete();
 
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
    }
}
