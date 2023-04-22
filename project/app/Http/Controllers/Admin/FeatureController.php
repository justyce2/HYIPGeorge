<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Datatables;
use Validator;
use Purifier;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Feature::orderBy('id','desc')->get();

         return Datatables::of($datas)
                            ->editColumn('icon', function(Feature $data) {
                                return '<i class="'.$data->icon.'"></i>';
                            })

                            ->editColumn('title', function(Feature $data) {
                                $title = strlen(strip_tags($data->title)) > 150 ? substr(strip_tags($data->title),0,150).'...' : strip_tags($data->title);
                                return  $title;
                            })

                            ->addColumn('action', function(Feature $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.feature.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.feature.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['icon', 'action'])
                            ->toJson();
    }

    public function index()
    {
        return view('admin.feature.index');
    }


    public function create()
    {
        return view('admin.feature.create');
    }


    public function store(Request $request)
    {
        $rules = [
            'icon'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Feature();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        }
        $input['details'] = Purifier::clean($request->details); 
        $data->fill($input)->save();
     
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.feature.index").'">View Feature Lists</a>';
        return response()->json($msg);       
    }


    public function edit($id)
    {
        $data = Feature::findOrFail($id);
        return view('admin.feature.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {

        $rules = [
            'photo'  => 'mimes:jpeg,jpg,png,svg',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Feature::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            @unlink('/assets/images/'.$data->photo); 
            $input['photo'] = $name;
        }
        $input['details'] = Purifier::clean($request->details); 
        $data->update($input);
   
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.feature.index").'">View Feature Lists</a>';
        return response()->json($msg);              
    }


    public function destroy($id)
    {
        $data = Feature::findOrFail($id);
        @unlink('/assets/images/'.$data->photo);
        $data->delete();
  
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
    }
}
