<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class BlogCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = BlogCategory::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         
         return Datatables::of($datas)
                            ->addColumn('action', function(BlogCategory $data) {
                                
                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.cblog.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.cblog.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();//--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.cblog.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.cblog.create');
    }

    //*** POST Request
    public function store(Request $request)
    {

        //--- Logic Section
        $rules = [
            'name' => 'unique:blog_categories',
            'slug' => 'unique:blog_categories',

             ];
         $customs = [
            'name.unique' => 'This name has already been taken.',
            'slug.unique' => 'This slug has already been taken.'
                ];
           $validator = Validator::make($request->all(), $rules, $customs);

            if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }

        $data = new BlogCategory;
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.' '.'<a href="'.route('admin.cblog.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = BlogCategory::findOrFail($id);
        return view('admin.cblog.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'unique:blog_categories,name,'.$id,
            'slug' => 'unique:blog_categories,slug,'.$id
             ];
         $customs = [
            'name.unique' => 'This name has already been taken.',
            'slug.unique' => 'This slug has already been taken.'
                ];
           $validator = Validator::make($request->all(), $rules, $customs);

            if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }

        //--- Logic Section
        $data = BlogCategory::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.' '.'<a href="'.route('admin.cblog.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends

    }

    //*** GET Request
    public function destroy($id)
    {
        $data = BlogCategory::findOrFail($id);

        //--- Check If there any blogs available, If Available Then Delete it
        if($data->blogs->count() > 0)
        {
            foreach ($data->blogs as $element) {
                $element->delete();
            }
        }
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
