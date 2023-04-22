<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Datatables;

class TransactionController extends Controller
{

    public function datatables()
    {
        $datas = Transaction::orderBy('id','desc')->get();  

        return Datatables::of($datas)
                        ->editColumn('amount', function(Transaction $data) {
                            $gs = Generalsetting::find(1);
                            return $gs->currency_sign.$data->amount;
                        })
                        ->editColumn('created_at', function(Transaction $data) {
                            $date = date('d-m-Y',strtotime($data->created_at));
                            return $date;
                        })
                        ->rawColumns([''])
                        ->toJson();
    }

    public function index(){
        return view('admin.transaction.index');
    }
}
