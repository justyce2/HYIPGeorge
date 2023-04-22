<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;


  Route::redirect('admin', 'admin/login');
  Route::post('the/genius/ocean/2441139', 'Frontend\FrontendController@subscription');
  Route::get('finalize', 'Frontend\FrontendController@finalize');

  Route::get('/under-maintenance', 'Frontend\FrontendController@maintenance')->name('front-maintenance');
  Route::group(['middleware'=>'maintenance'],function(){
    Route::get('/', 'Frontend\FrontendController@index')->name('front.index');
    
    Route::get('blogs', 'Frontend\FrontendController@blog')->name('front.blog');
    Route::get('blog/{slug}', 'Frontend\FrontendController@blogdetails')->name('blog.details');
    Route::get('/blog-search','Frontend\FrontendController@blogsearch')->name('front.blogsearch');
    Route::get('/blog/category/{slug}','Frontend\FrontendController@blogcategory')->name('front.blogcategory');
    Route::get('/blog/tag/{slug}','Frontend\FrontendController@blogtags')->name('front.blogtags');
    Route::get('/blog/archive/{slug}','Frontend\FrontendController@blogarchive')->name('front.blogarchive');

    Route::get('/plans','Frontend\FrontendController@plans')->name('front.plans');

    Route::get('/about', 'Frontend\FrontendController@about')->name('front.about');
    Route::get('/contact', 'Frontend\FrontendController@contact')->name('front.contact');
    Route::post('/contact','Frontend\FrontendController@contactemail')->name('front.contact.submit');
    Route::get('/faq', 'Frontend\FrontendController@faq')->name('front.faq');
    Route::get('/{slug}','Frontend\FrontendController@page')->name('front.page');
    Route::post('/subscriber', 'Frontend\FrontendController@subscriber')->name('front.subscriber');

    Route::post('/profit/calculate', 'Frontend\FrontendController@calculate')->name('front.profit.calculate');

    Route::get('/currency/{id}', 'Frontend\FrontendController@currency')->name('front.currency');
    Route::get('/language/{id}', 'Frontend\FrontendController@language')->name('front.language');

});
  Route::get('/profit/send', 'Frontend\FrontendController@profitSend')->name('front.profit.send');

