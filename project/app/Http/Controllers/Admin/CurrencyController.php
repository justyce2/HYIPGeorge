<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class CurrencyController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = Currency::orderBy('id','desc');
         return Datatables::of($datas)
                            ->addColumn('action', function(Currency $data) {

                                $delete = $data->is_default == 1 ? '':'<a href="javascript:;" data-href="' . route('admin.currency.delete',$data->id) . '" data-toggle="modal" data-target="#deleteModal" class="dropdown-item">'.__("Delete").'</a>';
                                $default = $data->is_default == 1 ? '<a href="javascript:;" class="dropdown-item"> '.__("Default").'</a>' : '<a class="status dropdown-item" href="javascript:;" data-href="' . route('admin.currency.status',['id1'=>$data->id,'id2'=>1]) . '">'.__('Set Default').'</a>';

                                return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.'Actions' .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="' . route('admin.currency.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>'.$delete.$default.'

                              </div>
                            </div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();
    }

    //*** GET Request
    public function index()
    {
        return view('admin.currency.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.currency.create');
    }

    //*** POST Request
    public function store(Request $request)
    {

        //--- Logic Section
        $data = new Currency();
        $input = $request->all();
        $isExist = Currency::where('is_default',1)->exists();
        if(!$isExist){
            $input['is_default'] = 1;
        }
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New Data Added Successfully.').' '.'<a href="'.route('admin.currency.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Currency::findOrFail($id);
        return view('admin.currency.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Logic Section
        $data = Currency::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.').' '.'<a href="'.route('admin.currency.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      public function status($id1,$id2)
        {
            $data = Currency::findOrFail($id1);
            $data->is_default = $id2;
            $data->update();
            $data = Currency::where('id','!=',$id1)->update(['is_default' => 0]);

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
        return __("You cant't remove the main currency.");
        }
        $data = Currency::findOrFail($id);
        if($data->is_default == 1) {
        Currency::where('id','=',1)->update(['is_default' => 1]);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

}
