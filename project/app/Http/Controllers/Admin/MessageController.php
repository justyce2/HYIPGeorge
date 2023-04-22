<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\AdminUserConversation;
use App\Models\AdminUserMessage;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function datatables()
    {
         $datas = AdminUserConversation::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)

                            ->editColumn('created_at', function(AdminUserConversation $data) {
                                $date = $data->created_at->diffForHumans();
                                return  $date;
                            })

                            ->addColumn('name', function(AdminUserConversation $data) {
                                $name = $data->user->name;
                                return  $name;
                            })
                            ->addColumn('action', function(AdminUserConversation $data) {

                            return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.message.show',$data->id) . '"  class="dropdown-item">'.__("Details").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.message.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                            })
                            ->rawColumns(['name','created_at','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.message.index');
    }
    public function message($id)
    {
        if(!AdminUserConversation::where('id',$id)->exists())
        {
            return redirect()->route('admin.dashboard')->with('unsuccess',__('Sorry the page does not exist.'));
        }
        $conv = AdminUserConversation::findOrfail($id);
        return view('admin.message.create',compact('conv'));
    }


    public function usercontact(Request $request)
    {
        $data = 1;
        $admin = Auth::guard('admin')->user();
        $user = User::where('email','=',$request->to)->first();
        if(empty($user))
        {
            $data = 0;
            return response()->json($data);
        }
        $to = $request->to;
        $subject = $request->subject;
        $from = $admin->email;
        $msg = "Email: ".$from."<br>Message: ".$request->message;
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {

        $datas = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];
        $mailer = new GeniusMailer();
         $mailer->sendCustomMail($datas);
        }
        else
        {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }


        $conv = AdminUserConversation::where('user_id','=',$user->id)->where('subject','=',$subject)->first();


        if(isset($conv)){
            $msg = new AdminUserMessage();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->save();
            return response()->json($data);
        }
        else{
            $message = new AdminUserConversation();
            $message->subject = $subject;
            $message->user_id= $user->id;
            $message->message=$request->message;
            $message->save();

            $msg = new AdminUserMessage();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->user_id=$user->id;
            $msg->save();

            return response()->json($data);
        }
    }
    public function postmessage(Request $request)
    {
        $msg = new AdminUserMessage();
        $input = $request->all();
        $msg->fill($input)->save();
        //--- Redirect Section
        $msg = 'Message Sent!';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    public function messageshow($id)
    {
        $conv = AdminUserConversation::findOrfail($id);
        return view('load.message',compact('conv'));
    }
    public function messagedelete($id)
    {
        $conv = AdminUserConversation::findOrfail($id);

         AdminUserMessage::where('conversation_id',$conv->id)->delete();
          $conv->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
