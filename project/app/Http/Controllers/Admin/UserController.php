<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Follow;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth:admin');
        }

        public function datatables()
        {
             $datas = User::orderBy('id','desc');

             return Datatables::of($datas)
                                ->addColumn('action', function(User $data) {
                                    return '<div class="btn-group mb-1">
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        '.'Actions' .'
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                        <a href="' . route('admin-user-show',$data->id) . '"  class="dropdown-item">'.__("Details").'</a>
                                        <a href="' . route('admin-user-edit',$data->id) . '" class="dropdown-item" >'.__("Edit").'</a>
                                        <a href="javascript:;" class="dropdown-item send" data-email="'. $data->email .'" data-toggle="modal" data-target="#vendorform">'.__("Send").'</a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin-user-delete',$data->id).'">'.__("Delete").'</a>
                                        </div>
                                    </div>';
                                })

                                ->addColumn('status', function(User $data) {
                                    $status      = $data->is_banned == 1 ? __('Block') : __('Unblock');
                                    $status_sign = $data->is_banned == 1 ? 'danger'   : 'success';

                                        return '<div class="btn-group mb-1">
                                        <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            '.$status .'
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin-user-ban',['id1' => $data->id, 'id2' => 0]).'">'.__("Unblock").'</a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin-user-ban',['id1' => $data->id, 'id2' => 1]).'">'.__("Block").'</a>
                                        </div>
                                        </div>';
                                })
                                ->rawColumns(['action','status'])
                                ->toJson();
        }

        public function index()
        {
            return view('admin.user.index');
        }

        public function image()
        {
            return view('admin.generalsetting.user_image');
        }

        public function show($id)
        {
            $data = User::findOrFail($id);
            $data['data'] = $data;
            return view('admin.user.show',$data);
        }

        public function ban($id1,$id2)
        {
            $user = User::findOrFail($id1);
            $user->is_banned = $id2;
            $user->update();
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
        }


        public function edit($id)
        {
            $data = User::findOrFail($id);
            return view('admin.user.edit',compact('data'));
        }


        public function update(Request $request, $id)
        {
            $rules = [
                   'photo' => 'mimes:jpeg,jpg,png,svg',
                    ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }

            $user = User::findOrFail($id);
            $data = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                if($user->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$user->photo)) {
                        unlink(public_path().'/assets/images/'.$user->photo);
                    }
                }
                $data['photo'] = $name;
            }
            $user->update($data);
            $msg = 'Customer Information Updated Successfully.';
            return response()->json($msg);
        }

        public function adddeduct(Request $request){
            $user = User::whereId($request->user_id)->first();
            if($user){
                if($request->type == 'add'){
                    $user->increment('balance',$request->amount);
                    return redirect()->back()->with('message','User balance added');
                }else{
                    if($user->balance>=$request->amount){
                        $user->decrement('balance',$request->amount);
                        return redirect()->back()->with('message','User balance deduct!');
                    }else{
                        return redirect()->back()->with('warning','User don,t have sufficient balance!');
                    }
                }
            }else{
                return redirect()->back()->with('warning','User not found!');
            }
        }

        public function withdraws(){
            return view('admin.user.withdraws');
        }

          public function withdrawdatatables()
          {
               $datas = Withdraw::orderBy('id','desc');

               return Datatables::of($datas)
                                  ->addColumn('email', function(Withdraw $data) {
                                      $email = $data->user->email;
                                      return $email;
                                  })
                                  ->addColumn('phone', function(Withdraw $data) {
                                    $phone = $data->user->phone;
                                    return $phone;
                                })
                                ->editColumn('status', function(Withdraw $data) {
                                    $status = ucfirst($data->status);
                                    return $status;
                                })

                                  ->editColumn('amount', function(Withdraw $data) {
                                      $amount = $data->amount;
                                      return '$' . $amount;
                                  })
                                  ->editColumn('created_at', function(Withdraw $data) {
                                    $date = $data->created_at->diffForHumans();
                                    return $date;
                                })


                               ->addColumn('action', function(Withdraw $data) {

                                if($data->status == "pending") {
                                    $action = '<a href="javascript:;" data-href="' . route('admin-withdraw-accept',$data->id) . '"  class="dropdown-item" data-toggle="modal"  data-target="#status-modal">'.__("Accept").'</a>
                                    <a href="javascript:;" data-href="' . route('admin-withdraw-reject',$data->id) . '"  class="dropdown-item" data-toggle="modal" data-target="#confirm-delete">'.__("Reject").'</a>
                                ';
                                }else{
                                    $action = '';
                                }
                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-href="' . route('admin.withdraw.show',$data->id) . '"  class="dropdown-item" id="applicationDetails" data-toggle="modal" data-target="#details">'.__("Details").'</a>'.$action.'

                                </div>
                              </div>';
                             })
                            ->rawColumns(['name','email','amount','action'])
                            ->toJson();
          }


    public function withdrawdetails($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        return view('admin.user.withdraw-details',compact('withdraw'));
    }


    public function accept($id)
    {
        $gs = Generalsetting::first();
        $admin = Admin::first();

        $withdraw = Withdraw::findOrFail($id);
        $user = User::findOrFail($withdraw->user->id);
        
        $data['status'] = "completed";
        $withdraw->update($data);

        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $user->email,
                'type' => "Withdraw",
                'cname' => $user->name,
                'oamount' => $withdraw->amount + $withdraw->fee,
                'aname' => $admin->name,
                'aemail' => $admin->email,
                'wtitle' => "",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);            
        }
        else
        {
           $to = $user->email;
           $subject = " You have invested successfully.";
           $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
           $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }

        $msg = __('Withdraw Accepted Successfully.');
        return response()->json($msg);

    }


    public function reject($id)
    {
        $gs = Generalsetting::first();
        $admin = Admin::first();

        $withdraw = Withdraw::findOrFail($id);
        $user = User::findOrFail($withdraw->user->id);
        $user->balance = $user->balance + $withdraw->amount + $withdraw->fee;

        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $withdraw->amount + $withdraw->fee;
        $trans->type = "Payout Rejected";
        $trans->profit = "plus";
        $trans->txnid = Str::random(12);
        $trans->user_id = $user->id;
        $trans->save();

        $user->update();

        $data['status'] = "rejected";
        $withdraw->update($data);

        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $user->email,
                'type' => "Withdraw",
                'cname' => $user->name,
                'oamount' => $withdraw->amount + $withdraw->fee,
                'aname' => $admin->name,
                'aemail' => $admin->email,
                'wtitle' => "",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);            
        }
        else
        {
           $to = $user->email;
           $subject = " You have invested successfully.";
           $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
           $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }


        $msg = __('Withdraw Rejected Successfully.');
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->transactions->count() > 0)
        {
            foreach ($user->transactions as $transaction) {
                $transaction->delete();
            }
        }

        if($user->withdraws->count() > 0)
        {
            foreach ($user->withdraws as $withdraw) {
                $withdraw->delete();
            }
        }

        if($user->deposits->count() > 0)
        {
            foreach ($user->deposits as $deposit) {
                $deposit->delete();
            }
        }

        if($user->balanceTransfers->count() > 0)
        {
            foreach ($user->balanceTransfers as $balanceTransfer) {
                $balanceTransfer->delete();
            }
        }

        @unlink('/assets/images/'.$user->photo);
        $user->delete();
        
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);       
    }

}
