<?php

namespace App\Http\Controllers\Admin;

use App\helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Rating;
use App\Models\Reply;
use App\Models\Wishlist;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables(Request $request)
    {
         $datas = Category::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                        ->addColumn('status', function(Category $data) {
                            $status      = $data->status == 1 ? __('Activated') : __('Deactivated');
                            $status_sign = $data->status == 1 ? 'success'   : 'danger';

                            return '<div class="btn-group mb-1">
                            <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            '.$status .'
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.cat.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Activate").'</a>
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.cat.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deactivate").'</a>
                            </div>
                        </div>';

                        })

                        ->addColumn('form', function(Category $data) use ($request) {
                              return '<div class="action-list"><a href="' . route('admin.form.create',$data->id) .'" class="btn btn-primary btn-sm btn-rounded edit"> <i class="fas fa-plus"></i> '.__('Create').'</a></div>';
                           })
                        ->addColumn('action', function(Category $data) {
                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.cat.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.cat.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                            })
                            ->rawColumns(['form','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'=> 'required',
            'demo_url_status'=> 'required',
            'photo' => 'mimes:jpeg,jpg,png,svg,webp',
            'slug' => 'unique:categories|regex:/^[a-zA-Z0-9\s-]+$/',
            'demo_url_status'=> 'required'
        ];

        $customs = [
            'name.required' => __('Name field is required.'),
            'photo.mimes' => __('Photo Type is Invalid.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
            'demo_url_status.required' => __('Demo Url field is required.')
        ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        //--- Logic Section
        $data = new Category();
        $input = $request->all();

        if ($file = $request->file('photo'))
         {
            $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/images',$name);
            $input['photo'] = $name;
        }

        if ($request->is_featured == ""){
            $input['is_featured'] = 0;
        }
        else {
            $input['is_featured'] = 1;
        }
        $input['slug'] = Str::slug($request->slug, '-');
        $input['demo_url_status'] = $request->demo_url_status;

        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New Data Added Successfully.').' '.'<a href="'.route('admin.cat.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

       //*** GET Request
       public function edit($id)
       {
           $data = Category::findOrFail($id);
           return view('admin.category.edit',compact('data'));
       }

       //*** POST Request
       public function update(Request $request, $id)
       {
           //--- Validation Section
           $rules = [
                'name'=> 'required',
                'demo_url_status'=> 'required',
                'photo' => 'mimes:jpeg,jpg,png,svg,webp',
                'slug' => 'unique:categories,slug,'.$id,
                'demo_url_status'=> 'required'
            ];

            $customs = [
                'name.required' => __('Name field is required.'),
                'photo.mimes' => __('Photo Type is Invalid.'),
                'slug.unique' => __('This slug has already been taken.'),
                'demo_url_status.required' => __('Demo Url field is required.')
            ];

           $validator = Validator::make($request->all(), $rules, $customs);

           if ($validator->fails()) {
             return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
           }
           //--- Validation Section Ends

           //--- Logic Section
           $data = Category::findOrFail($id);
           $input = $request->all();
               if ($file = $request->file('photo'))
               {
                    $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                   $file->move('assets/images',$name);
                   @unlink('/assets/images/'.$data->photo);

                   $input['photo'] = $name;
               }

               if ($request->is_featured == ""){
                   $input['is_featured'] = 0;
               }
               else {
                       $input['is_featured'] = 1;
               }

           $input['slug'] = Str::slug($request->slug, '-');
           $data->update($input);
           //--- Logic Section Ends

           //--- Redirect Section
           $msg = 'Data Updated Successfully.';
           return response()->json($msg);
           //--- Redirect Section Ends
       }

         //*** GET Request Status
         public function status($id1,$id2)
         {
             $data = Category::findOrFail($id1);
             $data->status = $id2;
             $data->update();

            //--- Redirect Section
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
            //--- Redirect Section Ends
         }


       //*** GET Request Delete
       public function destroy($id)
       {
           $data = Category::findOrFail($id);

           if($data->subs->count()>0)
           {
             //--- Redirect Section
             $msg = 'Remove its SubCategory first !';
             return response()->json($msg);
             //--- Redirect Section Ends
           }

           if($data->products->count()>0)
           {
             //--- Redirect Section
             $msg = 'Remove the products first !';
             return response()->json($msg);
             //--- Redirect Section Ends
           }



           //If Photo Doesn't Exist
           if($data->photo == null){
               $data->delete();
               //--- Redirect Section
               $msg = 'Data Deleted Successfully.';
               return response()->json($msg);
               //--- Redirect Section Ends
           }
           else{
               //If Photo Exist
           if (file_exists(public_path().'/assets/images/'.$data->photo)) {
            unlink(public_path().'/assets/images/'.$data->photo);
        }

        $data->delete();
        cache()->forget('categories');
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends

           }


       }
}
