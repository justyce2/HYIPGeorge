<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Datatables;
use Validator;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Service::orderBy('id','desc')->get();
         return Datatables::of($datas)
                            ->editColumn('photo', function(Service $data) {
                                $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->editColumn('title', function(Service $data) {
                                $title = strlen(strip_tags($data->title)) > 250 ? substr(strip_tags($data->title),0,250).'...' : strip_tags($data->title);
                                return  $title;
                            })
                            ->addColumn('action', function(Service $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.service.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.service.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['photo', 'action'])
                            ->toJson();
    }


    public function index()
    {
        return view('admin.service.index');
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request)
    {

        $rules = [
            'photo'      => 'required|mimes:jpeg,jpg,png,svg',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Service();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        } 
        $data->fill($input)->save();
   

        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.service.index").'">View Service Lists</a>';
        return response()->json($msg);      

    }


    public function edit($id)
    {
        $data = Service::findOrFail($id);
        return view('admin.service.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {

        $rules = [
            'photo'      => 'mimes:jpeg,jpg,png,svg',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Service::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            @unlink('/assets/images/'.$data->photo);          
            $input['photo'] = $name;
        } 
        $data->update($input);
    
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.service.index").'">View Service Lists</a>';
        return response()->json($msg);               
    }


    public function destroy($id)
    {
        $data = Service::findOrFail($id);
        @unlink('/assets/images/'.$data->photo);

        $data->delete();
   
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);       
    }
}
