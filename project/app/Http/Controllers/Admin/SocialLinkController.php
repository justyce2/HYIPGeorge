<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class SocialLinkController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function datatables()
    {
        $datas = SocialLinks::orderBy('id','desc');

        return Datatables::of($datas)
                          ->editColumn('status', function(SocialLinks $data) {
                              $status      = $data->status == 1 ? __('Activated') : __('Deativated');
                              $status_sign = $data->status == 1 ? 'success'   : 'danger';

                              return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.$status .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.social.links.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Active").'</a>
                                <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.social.links.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deativate").'</a>
                              </div>
                            </div>';
                          })


                          ->addColumn('action', function(SocialLinks $data) {
                            return '<div class="btn-group mb-1">
                            <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              '.'Actions' .'
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a href="' . route('admin.social.links.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                              <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.social.links.delete',$data->id).'">'.__("Delete").'</a>
                            </div>
                          </div>';

                          })
                          ->rawColumns(['status','action'])
                          ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.sociallinks.index');
    }

    public function create(){
        return view('admin.sociallinks.create');
    }

    public function store(Request $request){
        $rules = [
            'icon'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new SocialLinks();
        $input = $request->all();

        $data->fill($input)->save();
     
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.social.links.index").'">View Social Links Lists</a>';
        return response()->json($msg);  
    }

    public function edit($id){
        $data = SocialLinks::findOrFail($id);
        return view('admin.sociallinks.edit',compact('data'));
    }

    public function update(Request $request,$id){
        $rules = [
            'icon'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = SocialLinks::findOrFail($id);
        $input = $request->all();

        $data->update($input);
     
        $msg = 'New Updated Successfully.'.'<a href="'.route("admin.social.links.index").'">View Social Links Lists</a>';
        return response()->json($msg);  
    }

    public function status($id1,$id2)
    {
      $data = SocialLinks::findOrFail($id1);
      $data->status = $id2;
      $data->update();
      $mgs = __('Data Update Successfully.');
      return response()->json($mgs);
    }

    public function destroy($id){
        SocialLinks::findOrFail($id)->delete();
        $mgs = __('Data Deleted Successfully.');
        return response()->json($mgs);
    }
}
