<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\MoneyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class RequestMoneyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = MoneyRequest::orderBy('id','desc');

         return Datatables::of($datas)

                            ->editColumn('user_id', function(MoneyRequest $data) {
                                $data = User::whereId($data->user_id)->first();
                                if($data){
                                    return '<div>
                                            <span>'.$data->name.'</span>
                                            <p>'.$data->email.'</p>
                                    </div>';
                                }else{
                                    return $data = '';
                                }
                            }) 
                            ->editColumn('receiver_id', function(MoneyRequest $data){
                                $data = User::whereId($data->receiver_id)->first();
  
                                if($data){
                                    return '<div>
                                            <span>'.$data->name.'</span>
                                            <p>'.$data->email.'</p>
                                    </div>';
                                }else{
                                    return $data = '';
                                }
                            })
                            ->editColumn('amount', function(MoneyRequest $data) {
                                $curr = Currency::where('is_default','=',1)->first();
                                return $curr->sign.$data->amount;
                            })

                            ->editColumn('cost', function(MoneyRequest $data) {
                                $curr = Currency::where('is_default','=',1)->first();
                                return $curr->sign.$data->cost;
                            })

                            ->editColumn('status', function(MoneyRequest $data) {
                                $status      = $data->status == 1 ? _('Completed') : _('Pending');
                                $status_sign = $data->status == 1 ? 'success'   : 'warning';

                                return '<div class="btn-group mb-1">
                                        <span class="badge badge-'. $status_sign.'">'.$status.'</span>
                              </div>';
                            })

                            ->rawColumns(['user_id','receiver_id','amount','cost','status'])
                            ->toJson();
    }

    public function index(){
        return view('admin.requestmoney.index');
    }
    
    public function create(){
        return view('admin.requestmoney.create');
    }
}
