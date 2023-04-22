<?php

namespace App\Providers;

use App\Models\Font;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*',function($settings){
            $settings->with('seo', DB::table('seotools')->first());
            $settings->with('gs', DB::table('generalsettings')->first());
            $settings->with('pages', DB::table('pages')->whereStatus(1)->get());
            $settings->with('ps', DB::table('pagesettings')->first());
            $settings->with('social', DB::table('socialsettings')->first());
            $settings->with('default_font', Font::where('is_default','=',1)->first());
            $settings->with('defaultCurrency', Session::get('currency') ?  DB::table('currencies')->where('id','=',Session::get('currency'))->first() : DB::table('currencies')->where('is_default','=',1)->first());

            if (\Request::is('admin') || \Request::is('admin/*')) {
                $data = DB::table('admin_languages')->where('is_default','=',1)->first();
                App::setlocale($data->name);
            }
            else {

                if (Session::has('language')) {
                    $data = DB::table('languages')->find(Session::get('language'));

                    App::setlocale($data->name);
                }
                else {
                    $data = DB::table('languages')->where('is_default','=',1)->first();
                    App::setlocale($data->name);
                }
            }

            if (Session::has('currency')) {
                $data = DB::table('currencies')->find(Session::get('currency'));
                $settings->with('currency', $data);
            }
            else {
                $data = DB::table('currencies')->where('is_default','=',1)->first();
                $settings->with('currency', $data);
            }
        });
        Paginator::useBootstrap();


    }




}

