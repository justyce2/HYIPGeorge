<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Classes\GeniusMailer;
use App\Models\EmailTemplate;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Models\Subscriber;
use App\Models\User;

class EmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = EmailTemplate::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                            ->addColumn('action', function(EmailTemplate $data) {
                                return '<div class="action-list"><a class="btn btn-primary btn-sm btn-rounded" href="' . route('admin.mail.edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a></div>';
                            })
                            ->toJson();//--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.email.index');
    }

    public function config()
    {
        return view('admin.email.config');
    }

    public function edit($id)
    {
        $data = EmailTemplate::findOrFail($id);
        return view('admin.email.edit',compact('data'));
    }

    public function groupemail()
    {
        $config = Generalsetting::findOrFail(1);
        return view('admin.email.group',compact('config'));
    }

    public function groupemailpost(Request $request)
    {
        $config = Generalsetting::findOrFail(1);
        if($request->type == "User")
        {
        $users = User::whereIsBanned(0)->get();
        //Sending Email To Users
        foreach($users as $user)
        {
            if($config->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            }
            else
            {
               $to = $user->email;
               $subject = $request->subject;
               $msg = $request->body;
                $headers = "From: ".$config->from_name."<".$config->from_email.">";
               mail($to,$subject,$msg,$headers);
            }
        }
        //--- Redirect Section
        $msg = 'Email Sent Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
        else
        {
            $users = Subscriber::all();
            //Sending Email To Subscribers
            foreach($users as $user)
            {
                if($config->is_smtp == 1)
                {
                    $data = [
                        'to' => $user->email,
                        'subject' => $request->subject,
                        'body' => $request->body,
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                }
                else
                {
                $to = $user->email;
                $subject = $request->subject;
                $msg = $request->body;
                    $headers = "From: ".$config->from_name."<".$config->from_email.">";
                mail($to,$subject,$msg,$headers);
                }
            }
        }

        //--- Redirect Section
        $msg = 'Email Sent Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }




    public function update(Request $request, $id)
    {
        $data = EmailTemplate::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.mail.index").'">View Template Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

}
