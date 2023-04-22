<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use Illuminate\Http\Request;

class TransferLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $data['logs'] = BalanceTransfer::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);
        return view('user.transfer.index',$data);
    }
}
