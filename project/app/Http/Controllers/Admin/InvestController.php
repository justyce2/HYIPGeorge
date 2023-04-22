<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use Datatables;
use App\Models\Invest;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InvestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables(){
        $datas = Invest::orderBy('id','desc')->get();

        return Datatables::of($datas)
                        ->editColumn('user_id', function(Invest $data) {
                            return '<div>
                                    '.ucfirst($data->user->name).'
                                    <p>@'.$data->user->email.'</p>
                            </div>';
                        })
                        ->editColumn('plan_id', function(Invest $data) {
                            return  '<div>
                                        '.$data->plan->title.'
                                        <p>'.round($data->profit_amount,2).' / '.$data->plan->schedule->name.'</p>
                                </div>';
                        })
                        ->editColumn('amount', function(Invest $data){
                            $curr = Currency::where('is_default','=',1)->first();
                            $amount = $curr->value * $data->amount;
                            return '<div>
                                        <strong>'.$curr->sign.round($amount,2).'</strong>
                                    </div>';
                        })
                        ->editColumn('method', function(Invest $data) {
                            return '<div>
                                    '.ucfirst($data->method).'
                            </div>';
                        })
                        ->editColumn('status', function(Invest $data) {

                            if($data->status == 0){
                                $status = "Pending";
                                $status_sign = $data->status == 0 ? 'warning' : '';
                            }elseif($data->status == 1){
                                $status = "Running";
                                $status_sign = $data->status == 1 ? 'info' : '';
                            }else{
                                $status = "Completed";
                                $status_sign = $data->status == 2 ? 'success' : '';
                            }

                            return '<div class="btn-group mb-1">
                            <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              '.$status .'
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Pending").'</a>
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Running").'</a>
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'id2' => 2]).'">'.__("Completed").'</a>
                            </div>
                          </div>';
                        })
                        ->editColumn('profit_time', function(Invest $data){
                            return $data->profit_time ? $data->profit_time->toDateString() : '--';
                          })
                        ->rawColumns(['user_id','plan_id','amount','method','status','profit_time'])
                        ->toJson();
    }

    public function index(){
        return view('admin.invest.index');
    }

    public function status($id1,$id2){
        $data = Invest::findOrFail($id1);
        $user = User::whereId($data->user_id)->first();

        if($data->status == 2){
          $msg = 'Invest already completed';
          return response()->json($msg);
        }

        if($id2 == 2){
            $msg = 'Invest will completed automaticlly by the system';
            return response()->json($msg);
        }

        if($data->status == 1){
            $msg = 'Invest is running';
            return response()->json($msg);
        }

        $plan = Plan::whereId($data->plan_id)->first();
  
        $data->status = 1;
        $data->profit_time = Carbon::now()->addHours($plan->schedule_hour);
        $data->update();

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
            $subject = " You have invest successfully.";
            $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);            
        }
  
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
      }
}
