<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// API Routes.
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
//START API ROUTES FOR ONBOARDING 
    /*
    |These API end points are responsible for onboarding a user onto the MAZIMA app
    | right from the time they download the app to they time he completes membership payment
    */
    //start sms verification routes
$api->post('send-sms-verification-code', 'App\Http\Controllers\Auth\OnboardingController@sendVerifiationSMS'); 
$api->post('send-sms-reset-code', 'App\Http\Controllers\Auth\OnboardingController@sendResetCodeSMS'); 
$api->post('resend-sms-verification-code', 'App\Http\Controllers\Auth\OnboardingController@resendSMSVerifiationCode'); 
$api->post('verify-sms-code', 'App\Http\Controllers\Auth\OnboardingController@verifySMSCode');
$api->get('get-token', 'App\Http\Controllers\Auth\OnboardingController@token');
$api->get('refresh-token', 'App\Http\Controllers\Auth\OnboardingController@refreshToken');
    //end sms verification routes

    //start email verification routes
$api->post('send-email-verification-code', 'App\Http\Controllers\Auth\OnboardingController@sendEmailVerificationCode'); 
$api->post('resend-email-verification-code', 'App\Http\Controllers\Auth\OnboardingController@resendEmailVerificationCode'); 
$api->post('verify-email-code', 'App\Http\Controllers\Auth\OnboardingController@verifyEmailCode'); 
    //end email verification routes

    //start email verification routes
$api->post('resend-email-verification-code', 'App\Http\Controllers\Auth\OnboardingController@resendEmailVerificationCode'); 
$api->post('verify-email-code', 'App\Http\Controllers\Auth\OnboardingController@verifyEmailCode'); 
    //end email verification routes
    //start user registration routes
$api->post('signup', 'App\Http\Controllers\Auth\OnboardingController@registerUser');  
$api->post('login', 'App\Http\Controllers\Auth\OnboardingController@LoginUser'); 
    //end user registration routes
    
    //start membership payment verification routes
$api->post('set-target', 'App\Http\Controllers\Auth\OnboardingController@setTarget');
    //end membership payment verification routes
//END API ROUTES FOR ONBOARDING

//START INAPP ROUTES
//start pillfinder routes
$api->post('search-drugs', 'App\Http\Controllers\DrugController@searchDrugs');
$api->post('search-directory-drugs', 'App\Http\Controllers\DrugController@searchDirectoryDrugs');
$api->post('search-pharmacy', 'App\Http\Controllers\PharmacyController@searchPharmacy'); 
$api->post('search-location', 'App\Http\Controllers\LocationController@searchLocation');
$api->post('find-drugs', 'App\Http\Controllers\DrugController@findDrugs'); 
$api->post('get-drugs', 'App\Http\Controllers\DrugController@getDrugs'); 
$api->post('get-drug', 'App\Http\Controllers\DrugController@getDrug'); 
$api->post('get-similar-drugs', 'App\Http\Controllers\DrugController@getSimilarDrugs');

//start pharmacy locator routes
$api->post('find-map-pharmacies', 'App\Http\Controllers\PharmacyController@findMapPharmacies');
$api->post('find-pharmacy-schemes', 'App\Http\Controllers\InsuranceController@findPharmacySchemes');
$api->post('find-pharmacy', 'App\Http\Controllers\PharmacyController@findPharmacy');
$api->post('find-pharmacies', 'App\Http\Controllers\PharmacyController@findPharmacies');
$api->post('get-pharmacies', 'App\Http\Controllers\PharmacyController@getPharmacies');

//start insurance routes
$api->post('get-schemes', 'App\Http\Controllers\InsuranceController@getSchemes');
$api->post('get-scheme-pharmacies', 'App\Http\Controllers\InsuranceController@getSchemePharmacies');

//start market routes
$api->post('post-drug', 'App\Http\Controllers\MarketController@postDrug');
$api->post('get-posts', 'App\Http\Controllers\MarketController@getPosts');
$api->post('search-market-drugs', 'App\Http\Controllers\MarketController@searchMarketDrugs');
$api->post('buy-item-mm', 'App\Http\Controllers\MMController@buyItem');
$api->post('buy-item-cod', 'App\Http\Controllers\PaymentsController@buyItem');
$api->post('delete-drug', 'App\Http\Controllers\MarketController@deleteDrug');
//start chat routes
$api->post('search-chat-pharmacies', 'App\Http\Controllers\ChatController@searchPharmacies');
//settings routes
$api->post('upgrade-mm', 'App\Http\Controllers\MMController@makePayment');
$api->post('upgrade-paypal', 'App\Http\Controllers\PaypalController@makePayment');
$api->post('send-feedback', 'App\Http\Controllers\Auth\OnboardingController@sendFeedback');
$api->get('generate-ssl', 'App\Http\Controllers\PaymentsController@generateSSLCert');
//profile routes
$api->post('update-profile', 'App\Http\Controllers\Auth\OnboardingController@updateProfile');
$api->post('update-profile-photo', 'App\Http\Controllers\Auth\OnboardingController@updateProfilePhoto');

//password routes
 $api->post('change-password','App\Http\Controllers\Auth\AuthController@ChangePassword');

// Password reset link request routes...
$api->post('password/email', 'App\Http\Controllers\Auth\PasswordController@postEmail');

// Password reset routes...
$api->get('password/reset/{token}', 'App\Http\Controllers\Auth\PasswordController@getReset');
$api->post('password/reset', 'App\Http\Controllers\Auth\PasswordController@postReset');
//END INAPP ROUTES
});
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});