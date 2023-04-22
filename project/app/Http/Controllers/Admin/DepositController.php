<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class DepositController extends Controller
{
    public function datatables()
    {
        $datas = Deposit::orderBy('id','desc');  

        return Datatables::of($datas)
                        ->editColumn('created_at', function(Deposit $data) {
                            $date = date('d-m-Y',strtotime($data->created_at));
                            return $date;
                        })
                        ->addColumn('customer_name',function(Deposit $data){
                            $data = User::where('id',$data->user_id)->first();
                            return $data->name;
                        })
                        ->addColumn('customer_email',function(Deposit $data){
                            $data = User::where('id',$data->user_id)->first();
                            return $data->email;
                        })
                        ->editColumn('amount', function(Deposit $data) {
                            $gs = Generalsetting::find(1);
                            $defaultCurrency = Currency::where('is_default',1)->first();
                            return $defaultCurrency->sign.round($data->amount*$defaultCurrency->value);
                        })
                        ->editColumn('status', function(Deposit $data) {
                            $status      = $data->status == 'complete' ? _('completed') : _('pending');
                            $status_sign = $data->status == 'complete' ? 'success'   : 'danger';

                            return '<div class="btn-group mb-1">
                            <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              '.$status .'
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.deposits.status',['id1' => $data->id, 'id2' => 'complete']).'">'.__("Pending").'</a>
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.deposits.status',['id1' => $data->id, 'id2' => 'pending']).'">'.__("Completed").'</a>
                            </div>
                          </div>';
                        })
                        ->rawColumns(['created_at','customer_name','customer_email','amount','status'])
                        ->toJson();
    }

    public function index(){
        return view('admin.deposit.index');
    }

    public function status($id1,$id2){
        $data = Deposit::findOrFail($id1);

        if($data->status == 'complete'){
          $msg = 'Deposits already completed';
          return response()->json($msg);
        }
  
        $user = User::findOrFail($data->user_id);
        $user->balance += $data->amount;
        $user->save();

        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $data->amount;
        $trans->type = "Deposit";
        $trans->profit = "plus";
        $trans->txnid = $data->deposit_number;
        $trans->user_id = $user->id;
        $trans->save();

        $data->update(['status' => 'complete']);
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $user->email,
                'type' => "Deposit",
                'cname' => $user->name,
                'oamount' => $data->amount,
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);            
        }
        else
        {
            $to = $user->email;
            $subject = " You have deposited successfully.";
            $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);            
        }
  
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
      }
}
