<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\AccountProcessController;
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AuthorBadgeController;
use App\Http\Controllers\Admin\AuthorLevelController;
use App\Http\Controllers\Admin\AuthorTrendingController;
use App\Http\Controllers\Admin\BankPlanController;
use App\Http\Controllers\User\BeneficiaryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositController as AppDepositController;
use App\Http\Controllers\Admin\DpsController;
use App\Http\Controllers\Admin\DpsPlanController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FdrController;
use App\Http\Controllers\Admin\FdrPlanController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FontController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\InvestController;
use App\Http\Controllers\Admin\KycManageController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanPlanController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageScheduleController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OtherBankController;
use App\Http\Controllers\Admin\OtherBankTransferController;
use App\Http\Controllers\Admin\OwnBankTransferController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSettingController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ReferralController as AdminReferralController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoToolController;
use App\Http\Controllers\Admin\SocialSettingController;
use App\Http\Controllers\Admin\StaffController;

use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\RequestMoneyController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WireTransferBankController;
use App\Http\Controllers\Admin\WireTransferController as AdminWireTransferController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function(){

    Route::get('/cache/clear', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        return redirect()->route('admin.dashboard')->with('cache','System Cache Has Been Removed.');
    })->name('admin.cache.clear');
    
      Route::get('/login', [LoginController::class,'showLoginForm'])->name('admin.login');
      Route::post('/login', [LoginController::class,'login'])->name('admin.login.submit');
      Route::get('/forgot', [LoginController::class,'showForgotForm'])->name('admin.forgot');
      Route::post('/forgot-submit', [LoginController::class,'forgot'])->name('admin.forgot.submit');
      Route::get('/change-password/{token}', [LoginController::class,'showChangePassForm'])->name('admin.change.token');
      Route::post('/change-password', [LoginController::class,'changepass'])->name('admin.change.password');
      Route::get('/logout', [LoginController::class,'logout'])->name('admin.logout');
    
      Route::get('/profile', [DashboardController::class,'profile'])->name('admin.profile');
      Route::post('/profile/update', [DashboardController::class,'profileupdate'])->name('admin.profile.update');
    
      Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
      Route::get('/password', [DashboardController::class,'passwordreset'])->name('admin.password');
      Route::post('/password/update', [DashboardController::class,'changepass'])->name('admin.password.update');
    
      Route::group(['middleware'=>'permissions:Menu Builder'],function(){
        Route::get('/menu-builder', [GeneralSettingController::class,'menubuilder'])->name('admin.gs.menubuilder');
      });

      Route::get('/referrals',[AdminReferralController::class,'index'])->name('admin.referral.index');
      Route::post('/referral-level',[AdminReferralController::class,'store'])->name('admin.referral.store');

      Route::group(['middleware'=>'permissions:Manage Plan'],function(){
        Route::get('/schedule/datatables', [ManageScheduleController::class,'datatables'])->name('admin.schedule.datatables');
        Route::get('/schedule', [ManageScheduleController::class,'index'])->name('admin.schedule.index');
        Route::get('/schedule/create', [ManageScheduleController::class,'create'])->name('admin.schedule.create');
        Route::get('/schedule/edit/{id}', [ManageScheduleController::class,'edit'])->name('admin.schedule.edit');
        Route::post('/schedule/create', [ManageScheduleController::class,'store'])->name('admin.schedule.store');
        Route::post('/schedule/update/{id}', [ManageScheduleController::class,'update'])->name('admin.schedule.update');
        Route::get('/schedule/delete/{id}', [ManageScheduleController::class,'destroy'])->name('admin.schedule.delete');

        Route::get('/plans/datatables', [PlanController::class,'datatables'])->name('admin.plans.datatables');
        Route::get('/plans', [PlanController::class,'index'])->name('admin.plans.index');
        Route::get('/plans/create', [PlanController::class,'create'])->name('admin.plans.create');
        Route::get('/plans/edit/{id}', [PlanController::class,'edit'])->name('admin.plans.edit');
        Route::post('/plans/create', [PlanController::class,'store'])->name('admin.plans.store');
        Route::get('/plans/status/{id1}/{id2}', [PlanController::class,'status'])->name('admin.plans.status');
        Route::post('/plans/update/{id}', [PlanController::class,'update'])->name('admin.plans.update');
        Route::get('/plans/delete/{id}', [PlanController::class,'destroy'])->name('admin.plans.delete');
      });

      Route::group(['middleware'=>'permissions:Manage Customers'],function(){
        Route::get('/users/bonus', 'Admin\BonusController@index')->name('admin.user.bonus');
        Route::post('/users/edit/', 'Admin\BonusController@update')->name('admin.bonus.update');

        Route::get('/users/datatables', [UserController::class,'datatables'])->name('admin-user-datatables'); //JSON REQUEST
        Route::get('/users', [UserController::class,'index'])->name('admin.user.index');
        Route::get('/users/withdraws', [UserController::class,'withdraws'])->name('admin.withdraw.index');
        Route::get('/users/withdraws/datatables', [UserController::class,'withdrawdatatables'])->name('admin.withdraw.datatables');
        Route::get('/users/withdraw/{id}/show', [UserController::class,'withdrawdetails'])->name('admin.withdraw.show');
        Route::get('/users/withdraws/accept/{id}', [UserController::class,'accept'])->name('admin-withdraw-accept');
        Route::get('/users/withdraws/reject/{id}', [UserController::class,'reject'])->name('admin-withdraw-reject');
        Route::get('/users/edit/{id}', [UserController::class,'edit'])->name('admin-user-edit');
        Route::post('/users/edit/{id}', [UserController::class,'update'])->name('admin-user-update');
        Route::get('/users/delete/{id}', [UserController::class,'destroy'])->name('admin-user-delete');
        Route::get('/user/{id}/show', [UserController::class,'show'])->name('admin-user-show');
        Route::get('/users/ban/{id1}/{id2}', [UserController::class,'ban'])->name('admin-user-ban');
        Route::get('/user/default/image', [UserController::class,'image'])->name('admin-user-image');
        Route::get('/users/deposit/{id}', [UserController::class,'deposit'])->name('admin-user-deposit');
        Route::post('/user/deposit/{id}', [UserController::class,'depositUpdate'])->name('admin-user-deposit-update');
        Route::post('/user/balance/add/deduct', [UserController::class,'adddeduct'])->name('admin.user.balance.add.deduct');
  
        Route::get('/withdraw-method/datatables', [WithdrawMethodController::class,'datatables'])->name('admin.withdraw.method.datatables'); //JSON REQUEST
        Route::get('/withdraw-method', [WithdrawMethodController::class,'index'])->name('admin-withdraw-method-index');
        Route::get('/withdraw-method/create', [WithdrawMethodController::class,'create'])->name('admin.withdraw.method.create');
        Route::post('/withdraw-method/store', [WithdrawMethodController::class,'store'])->name('admin.withdraw.method.store');
        Route::get('/withdraw-method/edit/{id}', [WithdrawMethodController::class,'edit'])->name('admin.withdraw.method.edit');
        Route::post('/withdraw-method/update/{id}', [WithdrawMethodController::class,'update'])->name('admin.withdraw.method.update');
        Route::get('/withdraw-method/delete/{id}', [WithdrawMethodController::class,'destroy'])->name('admin.withdraw.method.delete');
      });

      Route::group(['middleware'=>'permissions:Invests'],function(){
        Route::get('/invests/datatables', [InvestController::class,'datatables'])->name('admin.invests.datatables');
        Route::get('/invests', [InvestController::class,'index'])->name('admin.invests.index');
        Route::get('/invests/status/{id1}/{id2}', [InvestController::class,'status'])->name('admin.invests.status');
      });

      Route::group(['middleware'=>'permissions:Transactions'],function(){
        Route::get('/transactions/datatables', [TransactionController::class,'datatables'])->name('admin.transactions.datatables');
        Route::get('/transactions', [TransactionController::class,'index'])->name('admin.transactions.index');
      });
    
      Route::group(['middleware'=>'permissions:Deposits'],function(){
        Route::get('/deposits/datatables',[AppDepositController::class,'datatables'])->name('admin.deposits.datatables');
        Route::get('/deposits',[AppDepositController::class,'index'])->name('admin.deposits.index');
        Route::get('/deposits/status/{id1}/{id2}', [AppDepositController::class,'status'])->name('admin.deposits.status');
      });

      Route::group(['middleware'=>'permissions:Request Money'],function(){
        Route::get('/request-money/datatables', [RequestMoneyController::class,'datatables'])->name('admin.request.datatables');
        Route::get('/request-money',[RequestMoneyController::class,'index'])->name('admin.request.money');
        Route::get('/request-money/create',[RequestMoneyController::class,'create'])->name('admin.request.setting.create');
      });

      Route::group(['middleware'=>'permissions:Manage Blog'],function(){
        Route::get('/blog/datatables', [BlogController::class,'datatables'])->name('admin.blog.datatables'); //JSON REQUEST
        Route::get('/blog', [BlogController::class,'index'])->name('admin.blog.index');
        Route::get('/blog/create', [BlogController::class,'create'])->name('admin.blog.create');
        Route::post('/blog/create', [BlogController::class,'store'])->name('admin.blog.store');
        Route::get('/blog/edit/{id}', [BlogController::class,'edit'])->name('admin.blog.edit');
        Route::post('/blog/edit/{id}', [BlogController::class,'update'])->name('admin.blog.update');
        Route::get('/blog/delete/{id}', [BlogController::class,'destroy'])->name('admin.blog.delete');
    
        Route::get('/blog/category/datatables', [BlogCategoryController::class,'datatables'])->name('admin.cblog.datatables'); //JSON REQUEST
        Route::get('/blog/category', [BlogCategoryController::class,'index'])->name('admin.cblog.index');
        Route::get('/blog/category/create', [BlogCategoryController::class,'create'])->name('admin.cblog.create');
        Route::post('/blog/category/create', [BlogCategoryController::class,'store'])->name('admin.cblog.store');
        Route::get('/blog/category/edit/{id}', [BlogCategoryController::class,'edit'])->name('admin.cblog.edit');
        Route::post('/blog/category/edit/{id}', [BlogCategoryController::class,'update'])->name('admin.cblog.update');
        Route::get('/blog/category/delete/{id}', [BlogCategoryController::class,'destroy'])->name('admin.cblog.delete');
      });

      Route::group(['middleware'=>'permissions:General Setting'],function(){
        Route::get('/general-settings/logo', [GeneralSettingController::class,'logo'])->name('admin.gs.logo');
        Route::get('/general-settings/favicon', [GeneralSettingController::class,'fav'])->name('admin.gs.fav');
        Route::get('/general-settings/loader', [GeneralSettingController::class,'load'])->name('admin.gs.load');
        Route::post('/general-settings/update/all', [GeneralSettingController::class,'generalupdate'])->name('admin.gs.update');
        Route::get('/general-settings/contents', [GeneralSettingController::class,'contents'])->name('admin.gs.contents');
        Route::get('/general-settings/moneytransfer', [GeneralSettingController::class,'moneytransfer'])->name('admin.gs.moneytransfer');
        Route::get('/general-settings/theme', [GeneralSettingController::class,'theme'])->name('admin.gs.theme');
    
        Route::get('/general-settings/breadcumb', [GeneralSettingController::class,'breadcumb'])->name('admin.gs.breadcumb');
        Route::get('/general-settings/status/{field}/{status}', [GeneralSettingController::class,'status'])->name('admin.gs.status');
        Route::get('/general-settings/footer', [GeneralSettingController::class,'footer'])->name('admin.gs.footer');
        Route::get('/general-settings/affilate', [GeneralSettingController::class,'affilate'])->name('admin.gs.affilate');
        Route::get('/general-settings/error-banner', [GeneralSettingController::class,'errorbanner'])->name('admin.gs.error.banner');
        Route::get('/general-settings/popup', [GeneralSettingController::class,'popup'])->name('admin.gs.popup');
        Route::get('/general-settings/maintenance', [GeneralSettingController::class,'maintain'])->name('admin.gs.maintenance');
        Route::get('/holiday-setting', [GeneralSettingController::class,'holiday'])->name('admin.gs.holiday');
    
        Route::get('/twilio-sms-settings', [GeneralSettingController::class,'twilio'])->name('admin.gs.twilio');
        Route::get('/nexmo-sms-settings', [GeneralSettingController::class,'nexmo'])->name('admin.gs.nexmo');
      });
    

    
      Route::group(['middleware'=>'permissions:Homepage Manage'],function(){
          Route::get('/feature/datatables', [FeatureController::class,'datatables'])->name('admin.feature.datatables'); //JSON REQUEST
          Route::get('/feature', [FeatureController::class,'index'])->name('admin.feature.index');
          Route::get('/feature/create', [FeatureController::class,'create'])->name('admin.feature.create');
          Route::get('/feature/edit/{id}', [FeatureController::class,'edit'])->name('admin.feature.edit');
          Route::post('/feature/create', [FeatureController::class,'store'])->name('admin.feature.store');
          Route::post('/feature/update/{id}', [FeatureController::class,'update'])->name('admin.feature.update');
          Route::get('/feature/delete/{id}', [FeatureController::class,'destroy'])->name('admin.feature.delete');
    
          Route::get('/account/process/datatables', [AccountProcessController::class,'datatables'])->name('admin.account.process.datatables'); //JSON REQUEST
          Route::get('/account/process', [AccountProcessController::class,'index'])->name('admin.account.process.index');
          Route::get('/account/process/create', [AccountProcessController::class,'create'])->name('admin.account.process.create');
          Route::get('/account/process/edit/{id}', [AccountProcessController::class,'edit'])->name('admin.account.process.edit');
          Route::post('/account/process/store', [AccountProcessController::class,'store'])->name('admin.account.process.store');
          Route::post('/account/process/edit/{id}', [AccountProcessController::class,'update'])->name('admin.account.process.update');
          Route::get('/account/process/delete/{id}', [AccountProcessController::class,'destroy'])->name('admin.account.process.delete');
    
          Route::get('/review/datatables', [ReviewController::class,'datatables'])->name('admin.review.datatables'); //JSON REQUEST
          Route::get('/review', [ReviewController::class,'index'])->name('admin.review.index');
          Route::get('/review/create', [ReviewController::class,'create'])->name('admin.review.create');
          Route::get('/review/edit/{id}', [ReviewController::class,'edit'])->name('admin.review.edit');
          Route::post('/review/store', [ReviewController::class,'store'])->name('admin.review.store');
          Route::post('/review/edit/{id}', [ReviewController::class,'update'])->name('admin.review.update');
          Route::get('/review/delete/{id}', [ReviewController::class,'destroy'])->name('admin.review.delete');
    
          Route::get('/counter/datatables', [CounterController::class,'datatables'])->name('admin.counter.datatables'); //JSON REQUEST
          Route::get('/counter', [CounterController::class,'index'])->name('admin.counter.index');
          Route::get('/counter/create', [CounterController::class,'create'])->name('admin.counter.create');
          Route::get('/counter/edit/{id}', [CounterController::class,'edit'])->name('admin.counter.edit');
          Route::post('/counter/store', [CounterController::class,'store'])->name('admin.counter.store');
          Route::post('/counter/edit/{id}', [CounterController::class,'update'])->name('admin.counter.update');
          Route::get('/counter/delete/{id}', [CounterController::class,'destroy'])->name('admin.counter.delete');

          Route::get('/brands/datatables', [BrandController::class,'datatables'])->name('admin.brands.datatables'); //JSON REQUEST
          Route::get('/brands', [BrandController::class,'index'])->name('admin.brands.index');
          Route::get('/brands/create', [BrandController::class,'create'])->name('admin.brands.create');
          Route::get('/brands/edit/{id}', [BrandController::class,'edit'])->name('admin.brands.edit');
          Route::post('/brands/store', [BrandController::class,'store'])->name('admin.brands.store');
          Route::post('/brands/edit/{id}', [BrandController::class,'update'])->name('admin.brands.update');
          Route::get('/brands/delete/{id}', [BrandController::class,'destroy'])->name('admin.brands.delete');

          Route::get('/partners/datatables', [PartnerController::class,'datatables'])->name('admin.partners.datatables'); //JSON REQUEST
          Route::get('/partners', [PartnerController::class,'index'])->name('admin.partners.index');
          Route::get('/partners/create', [PartnerController::class,'create'])->name('admin.partners.create');
          Route::get('/partners/edit/{id}', [PartnerController::class,'edit'])->name('admin.partners.edit');
          Route::post('/partners/store', [PartnerController::class,'store'])->name('admin.partners.store');
          Route::post('/partners/edit/{id}', [PartnerController::class,'update'])->name('admin.partners.update');
          Route::get('/partners/delete/{id}', [PartnerController::class,'destroy'])->name('admin.partners.delete');

          Route::get('/teams/datatables', [TeamController::class,'datatables'])->name('admin.teams.datatables'); //JSON REQUEST
          Route::get('/teams', [TeamController::class,'index'])->name('admin.teams.index');
          Route::get('/teams/create', [TeamController::class,'create'])->name('admin.teams.create');
          Route::get('/teams/edit/{id}', [TeamController::class,'edit'])->name('admin.teams.edit');
          Route::post('/teams/store', [TeamController::class,'store'])->name('admin.teams.store');
          Route::post('/teams/edit/{id}', [TeamController::class,'update'])->name('admin.teams.update');
          Route::get('/teams/delete/{id}', [TeamController::class,'destroy'])->name('admin.teams.delete');
    
          //------------ ADMIN MENU PAGE SETTINGS SECTION ------------
          Route::get('/page-settings/hero', [PageSettingController::class,'hero'])->name('admin.ps.hero');
          Route::get('/page-settings/referral', [PageSettingController::class,'referral'])->name('admin.ps.referral');
          Route::get('/page-settings/about', [PageSettingController::class,'about'])->name('admin.ps.about');
          Route::get('/page-settings/profit-calculate', [PageSettingController::class,'profit'])->name('admin.ps.profit');
          Route::get('/page-settings/call-to-action', [PageSettingController::class,'calltoaction'])->name('admin.ps.call');
          Route::get('/page-settings/section/heading', [PageSettingController::class,'sectionHeading'])->name('admin.ps.heading');
          Route::post('/page-settings/contact/update', [PageSettingController::class,'contactupdate'])->name('admin.ps.contactupdate');
          Route::post('/page-settings/update/all', [PageSettingController::class,'update'])->name('admin.ps.update');
          //------------ ADMIN PAGE SECTION ------------
    
      });
    
      Route::group(['middleware'=>'permissions:Email Setting'],function(){
        Route::get('/email-templates/datatables', [EmailController::class,'datatables'])->name('admin.mail.datatables');
        Route::get('/email-templates', [EmailController::class,'index'])->name('admin.mail.index');
        Route::get('/email-templates/{id}', [EmailController::class,'edit'])->name('admin.mail.edit');
        Route::post('/email-templates/{id}', [EmailController::class,'update'])->name('admin.mail.update');
        Route::get('/email-config', [EmailController::class,'config'])->name('admin.mail.config');
        Route::get('/groupemail', [EmailController::class,'groupemail'])->name('admin.group.show');
        Route::post('/groupemailpost', [EmailController::class,'groupemailpost'])->name('admin.group.submit');
      });
    
      
      Route::group(['middleware'=>'permissions:Message'],function(){
        Route::post('/send/message', [MessageController::class,'usercontact'])->name('admin.send.message');
        Route::get('/user/ticket', [MessageController::class,'index'])->name('admin.user.message');
        Route::get('/messages/datatables/', [MessageController::class,'datatables'])->name('admin.message.datatables');
        Route::get('/message/{id}', [MessageController::class,'message'])->name('admin.message.show');
        Route::get('/message/{id}/delete', [MessageController::class,'messagedelete'])->name('admin.message.delete');
        Route::post('/message/post', [MessageController::class,'postmessage'])->name('admin.message.store');
        Route::get('/message/load/{id}', [MessageController::class,'messageshow'])->name('admin-message-load');
      });

    
      Route::group(['middleware'=>'permissions:Payment Setting'],function(){
        Route::post('/general-settings/update/all',[ GeneralSettingController::class,'generalupdate'])->name('admin.gs.update');
        Route::get('/paymentgateway/datatables', [PaymentGatewayController::class,'datatables'])->name('admin.payment.datatables'); //JSON REQUEST
        Route::get('/paymentgateway', [PaymentGatewayController::class,'index'])->name('admin.payment.index');
        Route::get('/paymentgateway/create', [PaymentGatewayController::class,'create'])->name('admin.payment.create');
        Route::post('/paymentgateway/create', [PaymentGatewayController::class,'store'])->name('admin.payment.store');
        Route::get('/paymentgateway/edit/{id}', [PaymentGatewayController::class,'edit'])->name('admin.payment.edit');
        Route::post('/paymentgateway/update/{id}', [PaymentGatewayController::class,'update'])->name('admin.payment.update');
        Route::get('/paymentgateway/delete/{id}', [PaymentGatewayController::class,'destroy'])->name('admin.payment.delete');
        Route::get('/paymentgateway/status/{id1}/{id2}', [PaymentGatewayController::class,'status'])->name('admin.payment.status');
    
    
        Route::get('/general-settings/currency/{status}', [GeneralSettingController::class,'currency'])->name('admin.gs.iscurrency');
        Route::get('/currency/datatables', [CurrencyController::class,'datatables'])->name('admin.currency.datatables'); //JSON REQUEST
        Route::get('/currency',[ CurrencyController::class,'index'])->name('admin.currency.index');
        Route::get('/currency/create', [CurrencyController::class,'create'])->name('admin.currency.create');
        Route::post('/currency/create', [CurrencyController::class,'store'])->name('admin.currency.store');
        Route::get('/currency/edit/{id}', [CurrencyController::class,'edit'])->name('admin.currency.edit');
        Route::post('/currency/update/{id}', [CurrencyController::class,'update'])->name('admin.currency.update');
        Route::get('/currency/delete/{id}', [CurrencyController::class,'destroy'])->name('admin.currency.delete');
        Route::get('/currency/status/{id1}/{id2}', [CurrencyController::class,'status'])->name('admin.currency.status');
      });

    
      Route::group(['middleware'=>'permissions:Manage Roles'],function(){
        Route::get('/role/datatables', [RoleController::class,'datatables'])->name('admin.role.datatables');
        Route::get('/role', [RoleController::class,'index'])->name('admin.role.index');
        Route::get('/role/create', [RoleController::class,'create'])->name('admin.role.create');
        Route::post('/role/create', [RoleController::class,'store'])->name('admin.role.store');
        Route::get('/role/edit/{id}', [RoleController::class,'edit'])->name('admin.role.edit');
        Route::post('/role/edit/{id}', [RoleController::class,'update'])->name('admin.role.update');
        Route::get('/role/delete/{id}', [RoleController::class,'destroy'])->name('admin.role.delete');
      });
    
      Route::group(['middleware'=>'permissions:Manage Staff'],function(){
        Route::get('/staff/datatables', [StaffController::class,'datatables'])->name('admin.staff.datatables');
        Route::get('/staff', [StaffController::class,'index'])->name('admin.staff.index');
        Route::get('/staff/create', [StaffController::class,'create'])->name('admin.staff.create');
        Route::post('/staff/create', [StaffController::class,'store'])->name('admin.staff.store');
        Route::get('/staff/edit/{id}', [StaffController::class,'edit'])->name('admin.staff.edit');
        Route::post('/staff/update/{id}', [StaffController::class,'update'])->name('admin.staff.update');
        Route::get('/staff/delete/{id}', [StaffController::class,'destroy'])->name('admin.staff.delete');
      });

      Route::group(['middleware'=>'permissions:Manage KYC Form'],function(){
        Route::get('/manage-kyc/datatables', [KycManageController::class,'datatables'])->name('admin.manage.kyc.datatables');
        Route::get('/manage-kyc-form',[KycManageController::class,'index'])->name('admin.manage.kyc');
        Route::get('/manage-kyc-module',[KycManageController::class,'module'])->name('admin.manage.module');
        Route::get('/manage-kyc-form/{user}',[KycManageController::class,'userKycForm'])->name('admin.manage.kyc.user');
        Route::post('/manage-kyc-form/{user}',[KycManageController::class,'kycForm']);
        Route::post('/kyc-form/update',[KycManageController::class,'kycFormUpdate'])->name('admin.kyc.form.update');
        Route::post('/kyc-form/delete',[KycManageController::class,'deletedField'])->name('admin.kyc.form.delete');
        Route::get('/kyc-info/{user}',[KycManageController::class,'kycInfo'])->name('admin.kyc.info');
        Route::get('/kyc-info/user/{id}',[KycManageController::class,'kycDetails'])->name('admin.kyc.details');
        Route::get('/users/kyc/{id1}/{id2}', [KycManageController::class,'kyc'])->name('admin.user.kyc');
      });
    
      Route::group(['middleware'=>'permissions:Language Manage'],function(){
    
        Route::get('/general-settings/language/{status}',[ GeneralSettingController::class,'language'])->name('admin.gs.islanguage');
        Route::get('/languages/datatables', [LanguageController::class,'datatables'])->name('admin.lang.datatables');
        Route::get('/languages', [LanguageController::class,'index'])->name('admin.lang.index');
        Route::get('/languages/create', [LanguageController::class,'create'])->name('admin.lang.create');
        Route::get('/languages/edit/{id}', [LanguageController::class,'edit'])->name('admin.lang.edit');
        Route::post('/languages/create', [LanguageController::class,'store'])->name('admin.lang.store');
        Route::post('/languages/edit/{id}', [LanguageController::class,'update'])->name('admin.lang.update');
        Route::get('/languages/status/{id1}/{id2}', [LanguageController::class,'status'])->name('admin.lang.st');
        Route::get('/languages/delete/{id}',[ LanguageController::class,'destroy'])->name('admin.lang.delete');
      
      
        Route::get('/adminlanguages/datatables', [AdminLanguageController::class,'datatables'])->name('admin.tlang.datatables');
        Route::get('/adminlanguages', [AdminLanguageController::class,'index'])->name('admin.tlang.index');
        Route::get('/adminlanguages/create', [AdminLanguageController::class,'create'])->name('admin.tlang.create');
        Route::get('/adminlanguages/edit/{id}', [AdminLanguageController::class,'edit'])->name('admin.tlang.edit');
        Route::post('/adminlanguages/create', [AdminLanguageController::class,'store'])->name('admin.tlang.store');
        Route::post('/adminlanguages/edit/{id}', [AdminLanguageController::class,'update'])->name('admin.tlang.update');
        Route::get('/adminlanguages/status/{id1}/{id2}', [AdminLanguageController::class,'status'])->name('admin.tlang.st');
        Route::get('/adminlanguages/delete/{id}', [AdminLanguageController::class,'destroy'])->name('admin.tlang.delete');
      });
    
      Route::group(['middleware'=>'permissions:Fonts'],function(){
        Route::get('/fonts/datatables', [FontController::class,'datatables'])->name('admin.font.datatables');
        Route::get('/fonts', [FontController::class,'index'])->name('admin.font.index');
        Route::get('/font/create', [FontController::class,'create'])->name('admin.font.create');
        Route::post('/font/store', [FontController::class,'store'])->name('admin.font.store');
        Route::get('/font/edit/{id}', [FontController::class,'edit'])->name('admin.font.edit');
        Route::post('/font/update/{id}', [FontController::class,'update'])->name('admin.font.update');
        Route::get('/font/status/{id1}/{id2}', [FontController::class,'status'])->name('admin.font.status');
        Route::get('/font/delete/{id}', [FontController::class,'destroy'])->name('admin.font.delete');
      });
    
      Route::group(['middleware'=>'permissions:Menupage Setting'],function(){
        Route::get('/page-settings/contact', [PageSettingController::class,'contact'])->name('admin.ps.contact');
    
        Route::get('/page/datatables', [PageController::class,'datatables'])->name('admin.page.datatables'); //JSON REQUEST
        Route::get('/page', [PageController::class,'index'])->name('admin.page.index');
        Route::get('/page/create', [PageController::class,'create'])->name('admin.page.create');
        Route::post('/page/create', [PageController::class,'store'])->name('admin.page.store');
        Route::get('/page/edit/{id}', [PageController::class,'edit'])->name('admin.page.edit');
        Route::post('/page/update/{id}', [PageController::class,'update'])->name('admin.page.update');
        Route::get('/page/delete/{id}', [PageController::class,'destroy'])->name('admin.page.delete');
        Route::get('/page/status/{id1}/{id2}', [PageController::class,'status'])->name('admin.page.status');
    
        Route::get('/login-registration/page', [PageSettingController::class,'loginpage'])->name('admin.ps.login');
    
        Route::get('/faq/datatables', [FaqController::class,'datatables'])->name('admin.faq.datatables');
        Route::get('/admin-faq', [FaqController::class,'index'])->name('admin.faq.index');
        Route::get('/faq/create', [FaqController::class,'create'])->name('admin.faq.create');
        Route::get('/faq/edit/{id}', [FaqController::class,'edit'])->name('admin.faq.edit');
        Route::get('/faq/delete/{id}', [FaqController::class,'destroy'])->name('admin.faq.delete');
        Route::post('/faq/update/{id}', [FaqController::class,'update'])->name('admin.faq.update');
        Route::post('/faq/create', [FaqController::class,'store'])->name('admin.faq.store');
      });
    
      Route::group(['middleware'=>'permissions:Seo Tools'],function(){
        Route::get('/seotools/analytics', [SeoToolController::class,'analytics'])->name('admin.seotool.analytics');
        Route::post('/seotools/analytics/update', [SeoToolController::class,'analyticsupdate'])->name('admin.seotool.analytics.update');
        Route::get('/seotools/keywords', [SeoToolController::class,'keywords'])->name('admin.seotool.keywords');
        Route::post('/seotools/keywords/update', [SeoToolController::class,'keywordsupdate'])->name('admin.seotool.keywords.update');
        Route::get('/products/popular/{id}',[SeoToolController::class,'popular'])->name('admin.prod.popular');

        Route::get('/social-links/datatables', [SocialLinkController::class,'datatables'])->name('admin.social.links.datatables'); //JSON REQUEST
        Route::get('/social-links', [SocialLinkController::class,'index'])->name('admin.social.links.index');
        Route::get('/social-links/create', [SocialLinkController::class,'create'])->name('admin.social.links.create');
        Route::post('/social-links/create', [SocialLinkController::class,'store'])->name('admin.social.links.store');
        Route::get('/social-links/edit/{id}', [SocialLinkController::class,'edit'])->name('admin.social.links.edit');
        Route::post('/social-links/update/{id}', [SocialLinkController::class,'update'])->name('admin.social.links.update');
        Route::get('/social-links/delete/{id}', [SocialLinkController::class,'destroy'])->name('admin.social.links.delete');
        Route::get('/social-links/status/{id1}/{id2}', [SocialLinkController::class,'status'])->name('admin.social.links.status');
      });
    
      Route::group(['middleware'=>'permissions:Sitemaps'],function(){
        Route::get('/sitemap/datatables', [SitemapController::class,'datatables'])->name('admin.sitemap.datatables');
        Route::get('/sitemap',[SitemapController::class,'index'])->name('admin.sitemap.index');
        Route::get('/sitemap/create',[SitemapController::class,'create'])->name('admin.sitemap.create');
        Route::post('/sitemap/store', [SitemapController::class,'store'])->name('admin.sitemap.store');
        Route::get('/sitemap/{id}/update',[SitemapController::class,'update'])->name('admin.sitemap.update');
        Route::get('/sitemap/{id}/delete', [SitemapController::class,'delete'])->name('admin.sitemap.delete');
        Route::post('/sitemap/download', [SitemapController::class,'download'])->name('admin.sitemap.download');
      });
    
      Route::group(['middleware'=>'permissions:Subscribers'],function(){
        Route::get('/subscribers/datatables', [SubscriberController::class,'datatables'])->name('admin.subs.datatables'); //JSON REQUEST
        Route::get('/subscribers', [SubscriberController::class,'index'])->name('admin.subs.index');
        Route::get('/subscribers/download', [SubscriberController::class,'download'])->name('admin.subs.download');
      });
    
      Route::group(['middleware'=>'permissions:Social Setting'],function(){
        //------------ ADMIN SOCIAL SETTINGS SECTION ------------
        Route::get('/social', [SocialSettingController::class,'index'])->name('admin.social.index');
        Route::post('/social/update', [SocialSettingController::class,'socialupdate'])->name('admin.social.update');
        Route::post('/social/update/all', [SocialSettingController::class,'socialupdateall'])->name('admin.social.update.all');
        Route::get('/social/facebook', [SocialSettingController::class,'facebook'])->name('admin.social.facebook');
        Route::get('/social/google', [SocialSettingController::class,'google'])->name('admin.social.google');
        Route::get('/social/facebook/{status}', [SocialSettingController::class,'facebookup'])->name('admin.social.facebookup');
        Route::get('/social/google/{status}', [SocialSettingController::class,'googleup'])->name('admin.social.googleup');
        //------------ ADMIN SOCIAL SETTINGS SECTION ENDS------------
      });
    
        
      Route::get('/check/movescript', [DashboardController::class,'movescript'])->name('admin-move-script');
      Route::get('/generate/backup', [DashboardController::class,'generate_bkup'])->name('admin-generate-backup');
      Route::get('/activation', [DashboardController::class,'activation'])->name('admin-activation-form');
      Route::post('/activation', [DashboardController::class,'activation_submit'])->name('admin-activate-purchase');
      Route::get('/clear/backup', [DashboardController::class,'clear_bkup'])->name('admin-clear-backup');
    
    });