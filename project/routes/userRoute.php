<?php
use App\Http\Controllers;
use App\Http\Controllers\Deposit\AuthorizeController;
use App\Http\Controllers\Deposit\InstamojoController;
use App\Http\Controllers\Deposit\MollieController;
use App\Http\Controllers\Deposit\PaypalController;
use App\Http\Controllers\Deposit\PaytmController;
use App\Http\Controllers\Deposit\RazorpayController;
use App\Http\Controllers\Deposit\StripeController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\Deposit\FlutterwaveController;
use App\Http\Controllers\Deposit\ManualController;
use App\Http\Controllers\Deposit\PaystackController;
use App\Http\Controllers\User\ForgotController;
use App\Http\Controllers\User\KYCController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\MoneyRequestController;
use App\Http\Controllers\User\OTPController;
use App\Http\Controllers\User\PricingPlanController;
use App\Http\Controllers\User\ReferralController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\TransferLogController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WithdrawController;
use App\Http\Middleware\KYC;
use App\Http\Middleware\Otp;
use App\Models\Childcategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController as AppDashboardController;
use App\Http\Controllers\User\InvestController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\TransferController;

Route::prefix('user')->group(function() {

    Route::get('/login', [UserLoginController::class,'showLoginForm'])->name('user.login');
    Route::post('/login', [UserLoginController::class,'login'])->name('user.login.submit');

    Route::get('/forgot', [ForgotController::class,'showforgotform'])->name('user.forgot');
    Route::post('/forgot', [ForgotController::class,'forgot'])->name('user.forgot.submit'); 
  
    Route::get('/otp', [OTPController::class,'showotpForm'])->name('user.otp');
    Route::post('/otp', [OTPController::class,'otp'])->name('user.otp.submit');
  
    Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('user.register');
    Route::post('/register', [RegisterController::class,'register'])->name('user.register.submit');
    Route::get('/register/verify/{token}', [RegisterController::class,'token'])->name('user.register.token');  
  
    Route::group(['middleware' => ['otp','banuser']],function () {
  
      Route::get('/dashboard', [UserController::class,'index'])->name('user.dashboard');
      Route::get('/username/{number}', [UserController::class,'username'])->name('user.username');
      Route::get('/transactions', [UserController::class,'transaction'])->name('user.transaction'); 
  
      Route::get('/2fa-security', [UserController::class,'showTwoFactorForm'])->name('user.show2faForm');
      Route::post('/createTwoFactor', [UserController::class,'createTwoFactor'])->name('user.createTwoFactor');
      Route::post('/disableTwoFactor', [UserController::class,'disableTwoFactor'])->name('user.disableTwoFactor');
  
      Route::get('/profile', [UserController::class,'profile'])->name('user.profile.index'); 
      Route::post('/profile', [UserController::class,'profileupdate'])->name('user.profile.update');  
  
      Route::get('/kyc-form', [KYCController::class,'kycform'])->name('user.kyc.form');
      Route::post('/kyc-form', [KYCController::class,'kyc'])->name('user.kyc.submit');

      Route::group(['middleware'=>'kyc:Invest'],function(){
        Route::post('/invest/main',[InvestController::class,'mainWallet'])->name('user.invest.mainWallet');
        Route::post('/invest/interest',[InvestController::class,'interestWallet'])->name('user.invest.interestWallet');
        Route::post('/invest/amount',[InvestController::class,'investAmount'])->name('user.invest.amount');
        Route::get('/invest/checkout',[InvestController::class,'checkout'])->name('user.invest.checkout');
        Route::get('/invest/plans',[InvestController::class,'plans'])->name('user.invest.plans');
        Route::get('/invest/history',[InvestController::class,'planHistory'])->name('user.invest.history');
      });

  
      Route::group(['middleware'=>'kyc:Transfer & Request'],function(){
        Route::get('/request-money/receive',[MoneyRequestController::class,'receive'])->name('user.request.money.receive');
        Route::get('/money-request', [MoneyRequestController::class,'create'])->name('user.money.request.create');
        Route::post('/money-request/store', [MoneyRequestController::class,'store'])->name('user.money.request.store');
        Route::post('/request/money/send/{id}', [MoneyRequestController::class,'send'])->name('user.request.money.send');
        Route::get('/money-request/details/{id}', [MoneyRequestController::class,'details'])->name('user.money.request.details');

        Route::get('/money-transfer', [TransferController::class,'index'])->name('money.transfer.index');
        Route::post('/money-transfer', [TransferController::class,'store'])->name('money.transfer.store');
        Route::get('tranfer-logs',[TransferLogController::class,'index'])->name('tranfer.logs.index');
      });
  
  
      Route::group(['middleware'=>'kyc:Payouts'],function(){
        Route::get('/payout', [WithdrawController::class,'index'])->name('user.withdraw.index');
        Route::post('/payout/request', [WithdrawController::class,'store'])->name('user.withdraw.request');
        Route::get('/payouts/history', [WithdrawController::class,'history'])->name('user.withdraw.history');
        Route::get('/payout/{id}', [WithdrawController::class,'details'])->name('user.withdraw.details');
      });

      Route::group(['middleware'=>'kyc:Deposits'],function(){
        Route::get('/deposits',[DepositController::class,'index'])->name('user.deposit.index');
        Route::get('/deposit/create',[DepositController::class,'create'])->name('user.deposit.create');
      });

      Route::group(['middleware'=>'kyc:Deposits'],function(){
        Route::get('/referrals',[ReferralController::class,'referred'])->name('user.referral.index');
        Route::get('/referral-commissions',[ReferralController::class,'commissions'])->name('user.referral.commissions');
      });
  
  
      Route::get('/package',[PricingPlanController::class,'index'])->name('user.package.index');
      Route::get('/package/subscription/{id}',[PricingPlanController::class,'subscription'])->name('user.package.subscription');
  
      Route::post('/deposit/stripe-submit', [StripeController::class,'store'])->name('deposit.stripe.submit');
  
      Route::post('/deposit/paystack/submit', [PaystackController::class,'store'])->name('deposit.paystack.submit');
  
      Route::post('/paypal-submit', [PaypalController::class,'store'])->name('deposit.paypal.submit');
      Route::get('/paypal/deposit/notify', [PaypalController::class,'notify'])->name('deposit.paypal.notify');
      Route::get('/paypal/deposit/cancle', [PaypalController::class,'cancel'])->name('deposit.paypal.cancel');
  
      Route::post('/instamojo-submit',[InstamojoController::class,'store'])->name('deposit.instamojo.submit');
      Route::get('/instamojo-notify',[InstamojoController::class,'notify'])->name('deposit.instamojo.notify');
  
      Route::post('/deposit/paytm-submit', [PaytmController::class,'store'])->name('deposit.paytm.submit');
      Route::post('/deposit/paytm-callback', [PaytmController::class,'paytmCallback'])->name('deposit.paytm.notify');
  
      Route::post('/deposit/razorpay-submit', [RazorpayController::class,'store'])->name('deposit.razorpay.submit');
      Route::post('/deposit/razorpay-notify', [RazorpayController::class,'notify'])->name('deposit.razorpay.notify');
  
      Route::post('/deposit/molly-submit', [MollieController::class,'store'])->name('deposit.molly.submit');
      Route::get('/deposit/molly-notify', [MollieController::class,'notify'])->name('deposit.molly.notify');
  
      Route::post('/deposit/flutter/submit', [FlutterwaveController::class,'store'])->name('deposit.flutter.submit');
      Route::post('/deposit/flutter/notify', [FlutterwaveController::class,'notify'])->name('deposit.flutter.notify');
  
      Route::post('/authorize-submit', [AuthorizeController::class,'store'])->name('deposit.authorize.submit');
      Route::post('/deposit/manual-submit', [ManualController::class,'store'])->name('deposit.manual.submit');
  
      Route::get('/affilate/code', [UserController::class,'affilate_code'])->name('user-affilate-code');
  
  
      Route::get('/notf/show', 'User\NotificationController@user_notf_show')->name('customer-notf-show');
      Route::get('/notf/count','User\NotificationController@user_notf_count')->name('customer-notf-count');
      Route::get('/notf/clear','User\NotificationController@user_notf_clear')->name('customer-notf-clear');
  
      Route::get('support-tickets', [MessageController::class,'index'])->name('user.message.index');
      Route::get('create/support-tickets', [MessageController::class,'create'])->name('user.message.create');
      Route::post('support-tickets/store', [MessageController::class,'store'])->name('user.message.store');
      Route::get('support-tickets/show/{id}', [MessageController::class,'show'])->name('user.message.show');
      Route::post('support-tickets/conversation/{id}', [MessageController::class,'conversation'])->name('user.message.conversation');
      Route::get('admin/message/{id}/delete', [MessageController::class,'adminmessagedelete'])->name('user.message.delete1');   
  
      Route::get('/change-password', [UserController::class,'changePasswordForm'])->name('user.change.password.form');
      Route::post('/change-password', [UserController::class,'changePassword'])->name('user.change.password');
    });
  
  
    Route::get('/logout', [UserLoginController::class,'logout'])->name('user.logout');
  
  });