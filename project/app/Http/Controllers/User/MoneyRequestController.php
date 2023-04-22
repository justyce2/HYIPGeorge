<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BankPlan;
use App\Models\Generalsetting;
use App\Models\MoneyRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MoneyRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function receive(){
        $data['requests'] = MoneyRequest::orderby('id','desc')->whereReceiverId(auth()->id())->paginate(10);
        return view('user.requestmoney.receive',$data);
    }

    public function create(){
        $data['requests'] = MoneyRequest::orderby('id','desc')->whereUserId(auth()->id())->paginate(10);
        return view('user.requestmoney.create',$data);
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'amount' => 'required|gt:0',
        ]);

        $user = auth()->user();


        $gs = Generalsetting::first();

        if($request->email == $user->email){
            return redirect()->back()->with('unsuccess','You can not send money yourself!');
        }

        $user = User::where('email',$request->email)->first();
        if($user === null){
            return redirect()->back()->with('unsuccess','No register user with this email!');
        }


        $cost = $gs->fixed_request_charge + ($request->amount/100) * $gs->percentage_request_charge;
        $finalAmount = $request->amount + $cost;


        $receiver = User::where('email',$request->email)->first();

        $txnid = Str::random(4).time();

        $data = new MoneyRequest();
        $data->user_id = auth()->user()->id;
        $data->receiver_id = $receiver->id;
        $data->receiver_name = $receiver->name;
        $data->transaction_no = $txnid;
        $data->cost = $cost;
        $data->amount = $request->amount;
        $data->status = 0;
        $data->details = $request->details;
        $data->save();

        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $finalAmount;
        $trans->type = "Request Money";
        $trans->profit = "plus";
        $trans->txnid = $txnid;
        $trans->user_id = $user->id;
        $trans->save();

        return redirect()->back()->with('success','Request Money Send Successfully.');
        
    }

    public function send($id){
        $data = MoneyRequest::findOrFail($id);
    
        $sender = User::whereId($data->receiver_id)->first();
        $receiver = User::whereId($data->user_id)->first();


        if($data->amount > $sender->balance){
            return back()->with('warning','You don,t have sufficient balance!');
        }

        $finalAmount = $data->amount - $data->cost;

        $sender->decrement('balance',$data->amount);
        $receiver->increment('balance',$finalAmount);

        $data->update(['status'=>1]);

        $trans = new Transaction();
        $trans->email = auth()->user()->email;
        $trans->amount = $data->amount;
        $trans->type = "Request Money";
        $trans->profit = "minus";
        $trans->txnid = $data->transaction_no;
        $trans->user_id = auth()->id();
        $trans->save();

        $trans = new Transaction();
        $trans->email = $receiver->email;
        $trans->amount = $finalAmount;
        $trans->type = "Request Money";
        $trans->profit = "plus";
        $trans->txnid = $data->transaction_no;
        $trans->user_id = $receiver->id;
        $trans->save();

        return back()->with('message','Successfully Money Send.');
    }

    public function details($id){
        $data = MoneyRequest::findOrFail($id);
        $from = User::whereId($data->user_id)->first();
        $to = User::whereId($data->receiver_id)->first();
        return view('user.requestmoney.details',compact('data','from','to'));
    }
}
