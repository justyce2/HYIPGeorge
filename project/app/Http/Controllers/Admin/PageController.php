<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Purifier;
use Validator;

class PageController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function datatables()
  {
        $datas = Page::orderBy('id','desc');

        return Datatables::of($datas)
                          ->editColumn('status', function(Page $data) {
                              $status      = $data->status == 1 ? __('Activated') : __('Deativated');
                              $status_sign = $data->status == 1 ? 'success'   : 'danger';

                              return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.$status .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.page.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Active").'</a>
                                <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.page.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deativate").'</a>
                              </div>
                            </div>';
                          })


                          ->addColumn('action', function(Page $data) {
                            return '<div class="btn-group mb-1">
                            <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              '.'Actions' .'
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a href="' . route('admin.page.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                              <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.page.delete',$data->id).'">'.__("Delete").'</a>
                            </div>
                          </div>';

                          })
                          ->rawColumns(['status','action'])
                          ->toJson(); //--- Returning Json Data To Client Side
  }
  

    public function index()
    {
        return view('admin.page.index');
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {

        $slug = $request->slug;
        $main = array('home','faq','contact','blog','cart','checkout');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));
        }
        $rules = ['slug' => 'unique:pages'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $data = new Page();
        $input = $request->all();

        $common_rep   = ["value", "{", "}", "[","]",":","\""];
        $metatag = str_replace($common_rep, '', $request->meta_tag);

        if ($metatag)
         {
            $input['meta_tag'] = $metatag;
         }
        if ($request->secheck == "")
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
         $input['details'] = Purifier::clean($request->details);
        $data->fill($input)->save();

        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.page.index").'">View Page Lists</a>';
        return response()->json($msg);
    }


    public function edit($id)
    {
      $data = Page::findOrFail($id);
      return view('admin.page.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
      $data = Page::findOrFail($id);
      $input = $request->all();
      $common_rep   = ["value", "{", "}", "[","]",":","\""];
        $metatag = str_replace($common_rep, '', $request->meta_tag);

      if ($metatag)
        {
          $input['meta_tag'] = $metatag;
        }
        else {
          $input['meta_tag'] = null;
        }
      if ($request->secheck == "")
        {
          $input['meta_tag'] = null;
          $input['meta_description'] = null;
        }

      $input['details'] = Purifier::clean($request->details);
      $data->update($input);


      $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.page.index").'">View Page Lists</a>';
      return response()->json($msg);
    }


    public function status($id1,$id2)
    {
      $data = Page::findOrFail($id1);
      $data->status = $id2;
      $data->update();
      $mgs = __('Data Update Successfully.');
      return response()->json($mgs);
    }


    public function destroy($id)
    {
      $data = Page::findOrFail($id);
      $data->delete();
      
      //--- Redirect Section
      $msg = 'Data Deleted Successfully.';
      return response()->json($msg);
      //--- Redirect Section Ends
    }
}
