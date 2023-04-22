<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Pagesetting;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Brand::orderBy('id','desc')->get();
  
         return Datatables::of($datas)
                                ->editColumn('photo', function(Brand $data) {
                                    $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                    return '<img src="' . $photo . '" alt="Image">';
                                })

                                ->addColumn('action', function(Brand $data) {

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.brands.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.brands.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                                })
                                ->rawColumns(['photo', 'action'])
                                ->toJson();
    }

    public function index()
    {
        $data = Pagesetting::first();
        return view('admin.brands.index',compact('data'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'photo'  => 'required|mimes:jpeg,jpg,png,svg',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        $data = new Brand();
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
            $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);
            $input['photo'] = $name;
        }

        $data->fill($input)->save();

        $msg = 'New Data Added Successfully.'.' '.'<a href="'.route('admin.brands.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
    }

    public function edit($id)
    {
        $data = Brand::findOrFail($id);
        return view('admin.brands.edit',compact('data'));
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

        $data = Brand::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
            $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);
            @unlink('assets/images'.$data->photo);
            $input['photo'] = $name;
        }

        $data->update($input);

        $msg = 'Data Updated Successfully.'.' '.'<a href="'.route('admin.brands.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $data = Brand::findOrFail($id);
        @unlink('assets/images'.$data->photo);
        $data->delete();

        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
    }
}
