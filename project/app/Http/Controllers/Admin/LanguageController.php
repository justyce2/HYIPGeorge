<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Language::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('action', function(Language $data) {
                                $delete = $data->id == 1 ? '':'<a href="javascript:;" data-href="' . route('admin.lang.delete',$data->id) . '" data-toggle="modal" data-target="#deleteModal" class="dropdown-item">'.__("Delete").'</a>';
                                $default = $data->is_default == 1 ? '<a href="javascript:;" class="dropdown-item">'.__("Default").'</a>' : '<a class="status dropdown-item" href="javascript:;" data-href="' . route('admin.lang.st',['id1'=>$data->id,'id2'=>1]) . '">'.__('Set Default').'</a>';

                                return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.'Actions' .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="' . route('admin.lang.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>'.$delete.$default.'

                              </div>
                            </div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.language.index');
    }

    //*** GET Request
    public function create()
    {
        $data_results = file_get_contents(resource_path().'/lang/'.'default.json');
        $lang = json_decode($data_results, true);

        return view('admin.language.create',compact('lang'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'language'=>'required|unique:languages|max:255'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $new = null;
        $input = $request->all();
        $data = new Language();
        $data->language = $input['language'];
        $name = time().Str::random(8);
        $data->name = $name;
        $data->file = $name.'.json';
        $data->rtl = $input['rtl'];
        $isExist = Language::where('is_default',1)->exists();
        if(!$isExist){
            $data->is_default = 1;
        }
        $data->save();
        unset($input['_token']);
        unset($input['language']);
        $keys = $request->keys;
        $values = $request->values;

        foreach(array_combine($keys,$values) as $key => $value)
        {
            $n = str_replace("_"," ",$key);
            $new[$n] = $value;
        }

        $mydata = json_encode($new);
        file_put_contents(resource_path().'/lang/'.$data->file, $mydata);

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.' '.'<a href="'.route('admin.lang.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Language::findOrFail($id);
        $data_results = file_get_contents(resource_path().'/lang/'.$data->file);
        $lang = json_decode($data_results, true);
        return view('admin.language.edit',compact('data','lang'));

    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        $rules = [
            'language' => 'required|unique:languages,language,'.$id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
         return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

         //--- Logic Section
         $new = null;
         $input = $request->all();
         $data = Language::findOrFail($id);

         $data->update();
         unset($input['_token']);
         unset($input['language']);
         $keys = $request->keys;
         $values = $request->values;
         foreach(array_combine($keys,$values) as $key => $value)
         {
             $n = str_replace("_"," ",$key);
             $new[$n] = $value;
         }
         $mydata = json_encode($new);
         file_put_contents(resource_path().'/lang/'.$data->file, $mydata);

         $msg = 'Data Updated Successfully.'.' '.'<a href="'.route('admin.lang.index').'"> '.__('View Lists.').'</a>';
         return response()->json($msg);
         //--- Redirect Section Ends
    }

      public function status($id1,$id2)
        {
            $data = Language::findOrFail($id1);
            $data->is_default = $id2;
            $data->update();
            $data = Language::where('id','!=',$id1)->update(['is_default' => 0]);
            //--- Redirect Section
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
            //--- Redirect Section Ends
        }

    //*** GET Request Delete
    public function destroy($id)
    {
        if($id == 1)
        {
        return "You don't have access to remove this language";
        }
        $data = Language::findOrFail($id);
        if($data->is_default == 1)
        {
        return "You can not remove default language.";
        }


        @unlink(resource_path().'/lang/'.$data->file);
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
