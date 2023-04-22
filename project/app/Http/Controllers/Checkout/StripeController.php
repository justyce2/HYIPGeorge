<?php

namespace App\Http\Controllers\Checkout;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Config;

class StripeController extends Controller
{
    public $orderRepositorty;
    public  $allusers = [];
    
    public function __construct(OrderRepository $orderRepositorty)
    {
        $data = PaymentGateway::whereKeyword('Stripe')->first();
        $paydata = $data->convertAutoData();

        Config::set('services.stripe.key', $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);

        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){

        $gs = Generalsetting::findOrFail(1);
        $item_name = $gs->title." Invest";
        $item_number = Str::random(4).time();
        $item_amount = $request->amount;
        
        $support = ['USD'];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Currency For Stripe.');
        }

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('error','Token Problem With Your Token.');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $request->currency_code,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $addionalData = ['item_number'=>$item_number,'txnid'=>$charge['balance_transaction'],'charge_id'=>$charge['id']];
                    $this->orderRepositorty->order($request,'running',$addionalData);
  
                    return redirect()->route('user.invest.history')->with('message','Invest successfully complete.');
                }
                
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
        return back()->with('warning', 'Please Enter Valid Credit Card Informations.');
    }
}
