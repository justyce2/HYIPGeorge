<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Font;
use Datatables;
use Illuminate\Http\Request;
use Validator;

class FontController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Font::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                            ->addColumn('action', function(Font $data) {

                                $delete = $data->is_default == 1 ? '':'<a href="javascript:;" data-href="' . route('admin.font.delete',$data->id) . '" data-toggle="modal" data-target="#deleteModal" class="dropdown-item">'.__("Delete").'</a>';
                                $default = $data->is_default == 1 ? '<a href="javascript:;" class="dropdown-item">'.__("Default").'</a>' : '<a class="status dropdown-item" href="javascript:;" data-href="' . route('admin.font.status',['id1'=>$data->id,'id2'=>1]) . '">'.__('Set Default').'</a>';

                                return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.'Actions' .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="' . route('admin.font.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>'.$delete.$default.'

                              </div>
                            </div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.font.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.font.create');
    }

    public function store(Request $request){
        //--- Validation Section
        $rules = [
            'font_family' => 'required|unique:fonts',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = new Font();
        $input = $request->all();
        $input['font_value'] = preg_replace('/\s+/', '+',$request->font_family);

        if (Font::where('is_default', 1)->count() > 0) {
            $input['is_default'] = 0;
          } else {
            $input['is_default'] = 1;
        }
        $data->fill($input)->save();

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.font.index").'">View Post Lists</a>';

        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function edit($id){
        $data['data'] = Font::findOrFail($id);

        return view('admin.font.edit',$data);
    }

    public function update(Request $request,$id){
        //--- Validation Section
        $rules = [
            'font_family' => 'required|unique:fonts,font_family,'.$id,
                ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = Font::find($id);
        $input = $request->all();
        $input['font_value'] = preg_replace('/\s+/', '+',$request->font_family);
        $data->update($input);

        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.' '.'<a href="'.route('admin.font.index').'"> '.__('View Lists.').'</a>';

        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function status($id1,$id2)
    {
        $data = Font::findOrFail($id1);
        $data->is_default = $id2;
        $data->update();
        $data = Font::where('id','!=',$id1)->update(['is_default' => 0]);

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

       //*** GET Request Delete
   public function destroy($id)
   {
       if($id == 1)
       {
            $msg = __("You don't have access to remove this font.");
            return response()->json($msg);
       }
       $data = Font::findOrFail($id);

       if($data->is_default == 1)
       {
            $msg = __("You can not remove default font.");
            return response()->json($msg);
       }
       $data->delete();
       //--- Redirect Section
       $msg = __('Data Deleted Successfully.');
       return response()->json($msg);
       //--- Redirect Section Ends
   }
}
