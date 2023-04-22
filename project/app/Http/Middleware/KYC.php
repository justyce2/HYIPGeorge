<?php

namespace App\Http\Middleware;

use App\Models\Generalsetting;
use Illuminate\Support\Facades\Auth;
use Closure;

class KYC
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$value = null)
    {

        $gs = Generalsetting::first();
        $user = auth()->user();

        if($gs->kyc){
            if($user->kyc_status == 0 || $user->kyc_status == 2){
                $sections = explode(" , ", $gs->module_section);
                if (in_array($value, $sections)){
                    return redirect()->route('user.dashboard')->with('warning','Update Your KYC First and wait for verification!');
                }else{
                    return $next($request);
                }
            }
            return $next($request);
        }
        return $next($request);
    }
}
