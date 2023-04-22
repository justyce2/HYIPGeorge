<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;

class PaymentGatewayController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function datatables()
    {
        $datas = PaymentGateway::orderBy('id','desc')->get();
         return Datatables::of($datas)
                            ->editColumn('title', function(PaymentGateway $data) {
                                if($data->type == 'automatic'){
                                    return  $data->name;
                                }else{
                                    return  $data->title;
                                }
                            })
                            ->addColumn('status', function(PaymentGateway $data) {
                                $status      = $data->status == 1 ? __('Activated') : __('Deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.payment.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Activate").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.payment.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deactivate").'</a>
                                </div>
                              </div>';

                            })
                            ->addColumn('action', function(PaymentGateway $data) {
                                $editLink = route('admin.payment.edit',$data->id);
                                $deleteLink = route('admin.payment.delete',$data->id);

                                $delete = $data->type == 'automatic' || $data->keyword != null ? "" : '<button type="button" data-toggle="modal" data-target="#deleteModal"  data-href="' . $deleteLink . '" class="btn btn-danger btn-sm btn-rounded">
                                <i class="fas fa-trash"></i>
                                </button>';
                                return '<div class="actions-btn"><a href="' . $editLink . '" class="btn btn-primary btn-sm btn-rounded">
                                        <i class="fas fa-edit"></i> '.__("Edit").'
                                      </a>'.$delete.'</div>';


                                })
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    public function index()
    {
        return view('admin.payment.index');
    }

    public function create(){
        return view('admin.payment.create');
    }

    public function store(Request $request)
    {
        $rules = ['title' => 'unique:payment_gateways'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new PaymentGateway();
        $input = $request->all();
        $input['type'] = "manual";
        $data->fill($input)->save();
     
        $msg = __('New Data Added Successfully.').' '.'<a href="'.route("admin.payment.index").'">'.__('View Lists.').'</a>';
        return response()->json($msg);      
    }

    public function edit($id)
    {
        $data = PaymentGateway::findOrFail($id);
        return view('admin.payment.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {

        $data = PaymentGateway::findOrFail($id);
        $prev = '';

        if(PaymentGateway::where('name',$request->name)->where('id','!=',$id)->exists()){
            return response()->json(array('errors' => [0 =>'This name has already been taken.']));
        }


        if($data->type == "automatic"){

            $input = $request->all();

            $info_data = $input['pkey'];

            if($data->keyword == 'mollie'){
                $paydata = $data->convertAutoData();
                $prev = $paydata['key'];
            }



                if ($file = $request->file('photo'))
                {


                    $paydata = $data->convertAutoData();
                    $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                    $data->upload($name,$file,$paydata['photo']);
                    $info_data['photo']= $name;
                }

            else{

                if (strpos($data->information, 'photo') !== false) {
                    $paydata = $data->convertAutoData();
                    $info_data['photo'] = $paydata['photo'];
                }

            }


            if (array_key_exists("sandbox_check",$info_data)){
                $info_data['sandbox_check'] = 1;
            }else{
                if (strpos($data->information, 'sandbox_check') !== false) {
                    $info_data['sandbox_check'] = 0;
                    $text =  $info_data['text'];
                    unset($info_data['text']);
                    $info_data['text'] = $text;
                }
            }
            $input['information'] = json_encode($info_data);
            $data->update($input);


            if($data->keyword == 'mollie'){
                $paydata = $data->convertAutoData();
                $this->setEnv('MOLLIE_KEY',$paydata['key'],$prev);

            }
        }
        else{
            if(PaymentGateway::where('name',$request->name)->where('id','!=',$id)->exists()){
                return response()->json(array('errors' => [0 =>'This name has already been taken.']));
            }

            $input = $request->all();
            $data->update($input);
        }

        $msg = __('Data Updated Successfully.').' '.'<a href="'.route("admin.payment.index").'">'.__('View Lists.').'</a>';
        return response()->json($msg);
    }


    public function status($id1,$id2)
    {
        $data = PaymentGateway::findOrFail($id1);
        $data->status = $id2;
        $data->update();

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $data = PaymentGateway::findOrFail($id);
        if($data->type == 'manual' || $data->keyword != null){
            $data->delete();
        }
   
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
    }

}
