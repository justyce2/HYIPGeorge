<?php

namespace App\Http\Controllers\User;

use App\Classes\GoogleAuthenticator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUserConversation;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\Invest;
use App\Models\Order;
use App\Models\ReferralBonus;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use App\Traits\Payout;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['user'] = Auth::user();  
        $data['transactions'] = Transaction::whereUserId(auth()->id())->orderBy('id','desc')->limit(5)->get();
        $data['total_invests'] = Invest::whereUserId(auth()->id())->whereStatus(1)->sum('amount');
        $data['total_payouts'] = Withdraw::whereUserId(auth()->id())->whereStatus('completed')->sum('amount');
        $data['total_deposits'] = Deposit::whereUserId(auth()->id())->whereStatus('complete')->sum('amount');
        $data['total_transactions'] = Transaction::whereUserId(auth()->id())->sum('amount');
        $data['total_tickets'] = AdminUserConversation::whereUserId(auth()->id())->count();
        $data['total_referral_bonus'] = ReferralBonus::wheretoUserId(auth()->id())->sum('amount');
   
        return view('user.dashboard',$data);
    }

    public function transaction(Request $request)
    {
        $user = Auth::user();
        $transactions = Transaction::when($request->trx_no,function($query) use ($request){
                                        return $query->where('transaction_no', $request->trx_no);
                                    })
                                    ->when($request->type,function($query) use ($request){
                                        if($request->type != 'all'){
                                            return $query->where('type',$request->type);
                                        }else{
    
                                        }
                                    })
                                    ->whereUserId(auth()->id())->orderBy('id','desc')->paginate(20);  
        return view('user.transactions',compact('user','transactions'));
    }

    public function profile()
    {
        $user = Auth::user();  
        return view('user.profile',compact('user'));
    }

    public function profileupdate(Request $request)
    {
        $request->validate([
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'email' => 'unique:users,email,'.Auth::user()->id
        ]);

        $input = $request->all();  
        $data = Auth::user();        
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/',$name);
            @unlink('assets/images/'.$data->photo);
        
            $input['photo'] = $name;

            $input['is_provider'] = 0;
        }
         
        $data->update($input);
        $msg = 'Successfully updated your profile';
        return redirect()->back()->with('success',$msg);
    }

    public function changePasswordForm()
    {
        return view('user.changepassword');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    return redirect()->back()->with('unsuccess','Confirm password does not match.');
                }
            }else{
                return redirect()->back()->with('unsuccess','Current password Does not match.'); 
            }
        }
        $user->update($input);
        return redirect()->back()->with('success','Password Successfully Changed.'); 
    }

    public function showTwoFactorForm()
    {
        $gnl = Generalsetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $secret);
        $prevcode = $user->tsc;
        $prevqr = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $prevcode);

        return view('user.twofactor.index', compact('secret', 'qrCodeUrl', 'prevcode', 'prevqr'));
    }

    public function createTwoFactor(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        if ($oneCode == $request->code) {
            $user->go = $request->key;
            $user->twofa = 1;
            $user->save();
            
            return redirect()->back()->with('success','Two factor authentication activated');
        } else {
            return redirect()->back()->with('error','Something went wrong!');
        }
    }


    public function disableTwoFactor(Request $request)
    {

        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $ga = new GoogleAuthenticator();

        $secret = $user->go;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {

            $user->go = null;
            $user->twofa = 0;

            $user->save();

            return redirect()->back()->with('success','Two factor authentication disabled');
        } else {
            return redirect()->back()->with('error','Something went wrong!');
        }
    }

    public function username($email){
       if($data = User::where('email',$email)->first()){
           return $data->name;
       }else{
           return false;
       }
    }

    public function affilate_code()
    {
        $user = Auth::guard('web')->user();
        return view('user.affilate_code',compact('user'));
    }


}
