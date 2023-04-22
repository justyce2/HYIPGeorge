<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Validator;
use Purifier;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Blog::orderBy('id','desc');
    
         return Datatables::of($datas)
                            ->editColumn('photo', function(Blog $data) {
                                $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })

                            ->addColumn('action', function(Blog $data) {

                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.blog.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.blog.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';

                            })
                            ->rawColumns(['photo','action'])
                            ->toJson();
    }

    public function index()
    {
        return view('admin.blog.index');
    }

    public function create()
    {
        $data['cats'] = BlogCategory::all();
        return view('admin.blog.create',$data);
    }


    public function store(Request $request)
    {
        $rules = [
            'photo'      => 'required|mimes:jpeg,jpg,png,svg',
            'title'=>'required',
            'slug'=>'required|unique:blogs|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Blog();
        $input = $request->all();

        if ($file = $request->file('photo'))
         {
            $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);
            $input['photo'] = $name;
        }

        $input['slug']=Str::slug($request->slug);
        $common_rep   = ["value", "{", "}", "[","]",":","\""];
        $tag = str_replace($common_rep, '', $request->tags);
        $metatag = str_replace($common_rep, '', $request->meta_tag);


        if (!empty($metatag))
        {
            $input['meta_tag'] = $metatag;
        }


        if (!empty($tag))
        {
            $input['tags'] = $tag;
        }

        if ($request->secheck == "")
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }

        $input['views'] = 0;
        $data->fill($input)->save();

        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.blog.index").'">View Post Lists</a>';
        return response()->json($msg);
    }


    public function edit($id)
    {
        $cats = BlogCategory::all();
        $data = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('data','cats'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'photo'      => 'mimes:jpeg,jpg,png,svg',
            'title'=>'required',
            'slug' => 'required|unique:blogs,slug,'.$id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Blog::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
            $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);
            @unlink('assets/images/'.$data->photo);
            $input['photo'] = $name;
        }

        $common_rep   = ["value", "{", "}", "[","]",":","\""];
        $tag = str_replace($common_rep, '', $request->tags);
        $metatag = str_replace($common_rep, '', $request->meta_tag);



        if (!empty($metatag))
        {
            $input['meta_tag'] = $metatag;
        }
        if (!empty($tag))
         {
            $input['tags'] = $tag;
         }
        if ($request->secheck == "")
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
         $input['slug']=Str::slug($request->slug);
        $data->update($input);

        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.blog.index").'">View Post Lists</a>';
        return response()->json($msg);
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Blog::findOrFail($id);
        @unlink('assets/images/'.$data->photo);
        $data->delete();


        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
    }
}
