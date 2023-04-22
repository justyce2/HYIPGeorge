<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use DataTables;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function datatables()
    {
         $datas = Faq::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('details', function(Faq $data) {
                                $details = mb_strlen(strip_tags($data->details),'utf-8') > 100 ? mb_substr(strip_tags($data->details),0,100,'utf-8').'...' : strip_tags($data->details);
                                return  $details;
                            })
                            ->addColumn('action', function(Faq $data) {

                              return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.'Actions' .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="' . route('admin.faq.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.faq.delete',$data->id).'">'.__("Delete").'</a>
                              </div>
                            </div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index()
    {
        return view('admin.faq.index');
    }
    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {

        $data = new Faq();
        $input = $request->all();
        $data->fill($input)->save();

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.faq.index").'">View Faq Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    public function edit($id)
    {
        $data = Faq::findOrFail($id);
        return view('admin.faq.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {

        $data = Faq::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.faq.index").'">View Faq Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    public function destroy($id)
    {
        $data = Faq::findOrFail($id);
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
