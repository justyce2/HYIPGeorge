<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $data['deposits'] = Deposit::when($request->trx_no,function($query) use ($request){
                                        return $query->where('deposit_number', $request->trx_no);
                                    })
                                    ->when($request->type,function($query) use ($request){
                                        if($request->type != 'all'){
                                            return $query->where('method',$request->type);
                                        }else{

                                        }
                                    })
                                    ->orderby('id','desc')->whereUserId(auth()->id())->paginate(10);
        return view('user.deposit.index',$data);
    }

    public function create(){
        $data['availableGatways'] = ['flutterwave','authorize.net','razorpay','mollie','paytm','instamojo','stripe','paypal'];
        $data['gateways'] = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();
        $data['deposits'] = Deposit::orderby('id','desc')->whereUserId(auth()->id())->limit(5)->get();

        return view('user.deposit.create',$data);
    }
}
