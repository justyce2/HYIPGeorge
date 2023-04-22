<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\ManageSchedule;
use App\Models\Plan;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Plan::orderBy('id','desc')->get();

         return Datatables::of($datas)
                            ->editColumn('fixed_amount', function(Plan $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                if($data->fixed_amount == NULL){
                                    $amount = $sign->sign.$data->min_amount .' - '.$sign->sign.$data->max_amount;
                                }else{
                                    $amount = $sign->sign.$data->fixed_amount;
                                }
                                return  $amount;
                            })
                            ->editColumn('profit_percentage', function(Plan $data) {
                                return $data->profit_percentage.'%';
                            })
                            ->addColumn('status', function(Plan $data) {
                                $status      = $data->status == 1 ? __('Activated') : __('Deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';
    
                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.plans.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Activate").'</a>
                                <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.plans.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deactivate").'</a>
                                </div>
                            </div>';
    
                            })  
                            ->addColumn('action', function(Plan $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.plans.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.plans.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['fixed_amount','profit_percentage','status','action'])
                            ->toJson();
    }


    public function index()
    {
        return view('admin.plans.index');
    }

    public function create()
    {
        $data['currency'] = Currency::where('is_default','=',1)->first();
        $data['schedules'] = ManageSchedule::orderBy('id','desc')->get();
        return view('admin.plans.create',$data);
    }

    public function status($id1,$id2)
    {
        $data = Plan::findOrFail($id1);
        $data->status = $id2;
        $data->update();

        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:plans',
            'invest_type' => 'required',
            'min_amount'=> 'required_if:invest_type,range',
            'min_amount'=> 'required_if:invest_type,range',
            'profit_repeat'=> 'required_if:lifetime_return,0',
            'profit_percentage'=> 'required|numeric|gt:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Plan();
        $input = $request->all();

        if($request->invest_type == 'fixed'){
            $input['fixed_amount'] = baseCurrencyAmount($request->fixed_amount);
        }

        if($request->invest_type == 'range'){
            $input['min_amount'] =  baseCurrencyAmount($request->min_amount);
            $input['max_amount'] =  baseCurrencyAmount($request->max_amount);
        }

        $data->fill($input)->save();

        $msg = 'New Data Added Successfully.'.' '.'<a href="'.route('admin.plans.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
              
    }
 

    public function edit($id)
    {
        $data['data'] = Plan::findOrFail($id);
        $data['currency'] = Currency::where('is_default','=',1)->first();
        $data['schedules'] = ManageSchedule::orderBy('id','desc')->get();

        return view('admin.plans.edit',$data);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|unique:plans,title,'.$id,
            'invest_type' => 'required',
            'min_amount'=> 'required_if:invest_type,range',
            'min_amount'=> 'required_if:invest_type,range',
            'profit_repeat'=> 'required_if:lifetime_return,0',
            'profit_percentage'=> 'required|numeric|gt:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Plan::findOrFail($id);
        $input = $request->all();

        if($request->invest_type == 'fixed'){
            $input['fixed_amount'] = baseCurrencyAmount($request->fixed_amount);
        }else{
            $input['fixed_amount'] = NULL;
        }

        if($request->invest_type == 'range'){
            $input['min_amount'] =  baseCurrencyAmount($request->min_amount);
            $input['max_amount'] =  baseCurrencyAmount($request->max_amount);
        }else{
            $input['min_amount'] = NULL;
            $input['max_amount'] = NULL;
        }

        if($request->lifetime_return == 1){
            $input['profit_repeat'] = NULL;
        }

        $data->update($input);

        $msg = 'Data Updated Successfully.'.' '.'<a href="'.route('admin.plans.index').'"> '.__('View Lists.').'</a>';
        return response()->json($msg);
        
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        $msg = 'Plan Deleted Successfully.';
        return response()->json($msg);       
    }
}
