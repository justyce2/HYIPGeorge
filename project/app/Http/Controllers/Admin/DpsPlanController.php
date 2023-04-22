<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\DpsPlan;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class DpsPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = DpsPlan::orderBy('id','desc')->get();

         return Datatables::of($datas)

                            ->editColumn('per_installment', function(DpsPlan $data) {
                                $curr = Currency::where('is_default','=',1)->first();
                                return  '<div>
                                        <span class="text-primary">'.$curr->sign.$data->per_installment.'</span>/ <span class="text-primary">'.$data->installment_interval.'</span> Days
                                        <p>for <span class="text-primary">'.$data->total_installment.'</span> times.</p>
                                </div>';
                            }) 
                            ->editColumn('final_amount', function(DpsPlan $data){
                                $curr = Currency::where('is_default','=',1)->first();
                                return '<div>
                                        <span class="text-primary">'.$curr->sign.round($data->final_amount + $data->user_profit,2).'</span>
                                </div>';
                            })
                            ->editColumn('status', function(DpsPlan $data) {
                                $status      = $data->status == 1 ? _('activated') : _('deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.dps.plan.status',['id1' => $data->id, 'status' => 1]).'">'.__("activated").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.dps.plan.status',['id1' => $data->id, 'status' => 0]).'">'.__("deactivated").'</a>
                                </div>
                              </div>';
                            })
                            ->addColumn('action', function(DpsPlan $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.dps.plan.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.dps.plan.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['per_installment','final_amount','status','action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.dpsplan.index');
    }

    public function create(){
        $data['currency'] = Currency::whereIsDefault(1)->first();
        return view('admin.dpsplan.create',$data);
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required|max:255',
            'installment_interval' => 'required',
            'total_installment' => 'required',
            'per_installment' => 'required',
            'final_amount' => 'required',
            'user_profit' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $input = $request->all();
        $data = new DpsPlan();
        $data->fill($input)->save();

        $msg = 'New Plan Added Successfully.<a href="'.route('admin.dps.plan.index').'">View Plan Lists.</a>';
        return response()->json($msg); 
    }

    public function edit(Request $request, $id){
        $data['data'] = DpsPlan::findOrFail($id);
        $data['currency'] = Currency::whereIsDefault(1)->first();

        return view('admin.dpsplan.edit',$data);
    }

    public function update(Request $request, $id){
        $rules = [
            'title' => 'required|max:255',
            'installment_interval' => 'required',
            'total_installment' => 'required',
            'per_installment' => 'required',
            'final_amount' => 'required',
            'user_profit' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = DpsPlan::findOrFail($id);
        $input = $request->all();

        $data->update($input);

        $msg = 'New Plan Updated Successfully.<a href="'.route('admin.dps.plan.index').'">View Plan Lists.</a>';
        return response()->json($msg); 
    }

    public function status($id1,$id2)
    {
        $data = DpsPlan::findOrFail($id1);
        $data->status = $id2;
        $data->update();

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $data = DpsPlan::findOrFail($id);
        $data->delete();

        $msg = 'Plan Deleted Successfully.';
        return response()->json($msg);       
    }
}
