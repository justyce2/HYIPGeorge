<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Invest;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class InvestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mainWallet(Request $request){
        if($request->amount>0){
            if($plan = Plan::whereId($request->investId)->first()){
                if($plan->invest_type == 'range'){
                    if(rootPrice($plan->min_amount) > $request->amount ){
                        return redirect()->back()->with('warning','Amount Should be greater than this!');
                    }

                    if($request->amount > rootPrice($plan->max_amount)){
                        return redirect()->back()->with('warning','Amount Should be less than this.');
                    }
                }

                if($request->amount < rootPrice(auth()->user()->balance)){
                    $currency = Currency::first();

                    $invest = new Invest();
                    $invest->transaction_no = Str::random(12);
                    $invest->user_id = auth()->id();
                    $invest->plan_id = $plan->id;
                    $invest->currency_id = $currency->id;
                    $invest->method = 'Main Wallet';
                    $invest->amount = investCurrencyAmount($request->amount);
                    $profitAmount = ($request->amount * $plan->profit_percentage)/100;
                    $invest->profit_amount = investCurrencyAmount($profitAmount);

                    if($plan->lifetime_return){
                        $invest->lifetime_return = 1;
                    }
            
                    if($plan->captial_return){
                        $invest->capital_back = 1;
                        $invest->profit_repeat = 0;
                    }
                    $invest->status = 1;
                    $invest->payment_status = "completed";
                    $invest->profit_time = Carbon::now()->addHours($plan->schedule_hour);
                    $invest->save();

                    $user = auth()->user();
                    $user->balance = $user->balance - investCurrencyAmount($request->amount);
                    $user->update();

                    $trans = new Transaction();
                    $trans->email = auth()->user()->email;
                    $trans->amount = $invest->amount;
                    $trans->type = "Invest";
                    $trans->txnid = $invest->transaction_no;
                    $trans->user_id = $invest->user_id;
                    $trans->save();

                    return redirect()->back()->with('message','Invest successfully completed.');
                }else{
                    return redirect()->back()->with('warning','You don,t have sufficient balance.');
                }

                return redirect()->route('user.invest.checkout');
            }
        }else{
            return redirect()->route('front.index')->with('warning','Amount should be greater then 0!');
        }
    }


    public function interestWallet(Request $request){
        if($request->amount>0){
            if($plan = Plan::whereId($request->investId)->first()){
                if($plan->invest_type == 'range'){
                    if(rootPrice($plan->min_amount) > $request->amount ){
                        return redirect()->back()->with('warning','Amount Should be greater than this!');
                    }

                    if($request->amount > rootPrice($plan->max_amount)){
                        return redirect()->back()->with('warning','Amount Should be less than this.');
                    }
                }

                if($request->amount < rootPrice(auth()->user()->interest_balance)){
                    $currency = Currency::first();

                    $invest = new Invest();
                    $invest->transaction_no = Str::random(12);
                    $invest->user_id = auth()->id();
                    $invest->plan_id = $plan->id;
                    $invest->currency_id = $currency->id;
                    $invest->method = 'Interest Wallet';
                    $invest->amount = investCurrencyAmount($request->amount);
                    $profitAmount = ($request->amount * $plan->profit_percentage)/100;
                    $invest->profit_amount = investCurrencyAmount($profitAmount);

                    if($plan->lifetime_return){
                        $invest->lifetime_return = 1;
                    }
            
                    if($plan->captial_return){
                        $invest->capital_back = 1;
                        $invest->profit_repeat = 0;
                    }
                    $invest->status = 1;
                    $invest->payment_status = "completed";
                    $invest->profit_time = Carbon::now()->addHours($plan->schedule_hour);
                    $invest->save();

                    $user = auth()->user();
                    $user->interest_balance =$user->interest_balance - investCurrencyAmount($request->amount);
                    $user->update();

                    $trans = new Transaction();
                    $trans->email = auth()->user()->email;
                    $trans->amount = $invest->amount;
                    $trans->type = "Invest";
                    $trans->txnid = $invest->transaction_no;
                    $trans->user_id = $invest->user_id;
                    $trans->save();

                    return redirect()->back()->with('message','Invest successfully completed.');
                }else{
                    return redirect()->back()->with('warning','You don,t have sufficient balance.');
                }

                return redirect()->route('user.invest.checkout');
            }
        }else{
            return redirect()->route('front.index')->with('warning','Amount should be greater then 0!');
        }
    }

    public function investAmount(Request $request){
        if($request->amount>0){
            if($plan = Plan::whereId($request->investId)->first()){
                if($plan->invest_type == 'range'){
                    if(rootPrice($plan->min_amount) > $request->amount ){
                        return redirect()->back()->with('warning','Amount Should be greater than this!');
                    }

                    if($request->amount > rootPrice($plan->max_amount)){
                        return redirect()->back()->with('warning','Amount Should be less than this');
                    }
                }
                session(['invest_amount'=>investCurrencyAmount($request->amount),'currencyId'=>1,'investPlanId'=>$plan->id]);
                return redirect()->route('user.invest.checkout');
            }
        }else{
            return redirect()->route('front.index')->with('warning','Amount should be greater then 0!');
        }
    }

    public function planHistory(Request $request){
        $data['invests'] = Invest::when($request->trx_no,function($query) use ($request){
                                        return $query->where('transaction_no', $request->trx_no);
                                        // return $query->where('user_id', auth()->id());
                                    })
                                    ->when($request->type,function($query) use ($request){
                                        if($request->type == 'pending'){
                                            return $query->where('status',0);
                                        }elseif($request->type == 'running'){
                                            return $query->where('status',1);
                                        }elseif($request->type == 'completed'){
                                            return $query->where('status',2);
                                        }else{
    
                                        }
                                    })
                                    ->orderBy('id','desc')->paginate(10);
        return view('user.invest.history',$data);
    }

    public function plans(){
        $data['plans'] = Plan::whereStatus(1)->orderBy('id','desc')->get();
        return view('user.invest.plans',$data);
    }

    public function checkout(){
        $data['invests'] = Invest::orderBy('id','desc')->limit(5)->get();
        $data['gateways'] = PaymentGateway::where('status',1)->get();
        return view('user.invest.create',$data);
    }
}
