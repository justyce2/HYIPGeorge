<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['transfers'] = BalanceTransfer::orderBy('id','desc')->paginate(10);
        return view('user.transfer.index',$data);
    }

    public function store(Request $request){

        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'amount' => 'required|gt:0',
            'wallet' => 'required',
            'password' => 'required'
        ]);
        
        $user = auth()->user();
        if(!Hash::check($request->password,$user->password)){
            return redirect()->back()->with('unsuccess','Password does not match!');
        }

        if($request->wallet == 'main_balance'){
            if($request->amount > $user->balance){
                return redirect()->back()->with('unsuccess','Insufficient Main Account Balance.');
            }
        }else{
            if($request->amount > $user->interest_balance){
                return redirect()->back()->with('unsuccess','Insufficient Interest Account Balance.');
            }
        }
        
        $gs = Generalsetting::first();

        if($request->email == $user->email){
            return redirect()->back()->with('unsuccess','You can not send money yourself!!');
        }

        
        if($receiver = User::where('email',$request->email)->first()){
            $txnid = Str::random(4).time();
            $data = new BalanceTransfer();
            $data->user_id = $user->id;
            $data->receiver_id = $receiver->id;
            $data->transaction_no = $txnid;
            $data->cost = 0;
            $data->amount = $request->amount;
            $data->status = 1;
            $data->save();
    
            $receiver->increment('balance',$request->amount);
            if($request->wallet == 'main_balance'){
                $user->decrement('balance',$request->amount);
            }else{
                $user->decrement('interest_balance',$request->amount);
            }

            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $request->amount;
            $trans->type = "Send Money";
            $trans->profit = "minus";
            $trans->txnid = $txnid;
            $trans->user_id = $user->id;
            $trans->save();

            $receivertrans = new Transaction();
            $receivertrans->email = $receiver->email;
            $receivertrans->amount = $request->amount;
            $receivertrans->type = "Receive Money";
            $receivertrans->profit = "plus";
            $receivertrans->txnid = $txnid;
            $receivertrans->user_id = $receiver->id;
            $receivertrans->save();

            return redirect()->back()->with('success','Money Send Successfully.');
        }else{
            return redirect()->back()->with('unsuccess','Sender not found!');
        }
    }
}
