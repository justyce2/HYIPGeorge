<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Datatables;
use Validator;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Team::orderBy('id','desc')->get();

         return Datatables::of($datas)
                            ->editColumn('photo', function(Team $data) {
                                $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })

                            ->addColumn('action', function(Team $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.teams.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.teams.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.teams.index');
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'photo' => 'required|mimes:jpeg,jpg,png,svg',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Team();
        $input = $request->all();
        if ($file = $request->file('photo'))
        {
          $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
          $file->move('assets/images',$name);
          $input['photo'] = $name;
        } 
        $data->fill($input)->save();
      
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.teams.index").'">View Lists</a>';
        return response()->json($msg);         
    }

    public function edit($id)
    {
        $data = Team::findOrFail($id);
        return view('admin.teams.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Team::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
          $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
          $file->move('assets/images',$name);
          @unlink('assets/images/'.$data->photo);
          $input['photo'] = $name;
        } 
        $data->update($input);
  
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.teams.index").'">View Lists</a>';
        return response()->json($msg);                
    }

    public function destroy($id)
    {
        $data = Team::findOrFail($id);
        @unlink('assets/images/'.$data->photo);
        $data->delete();
 
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
    }
}
