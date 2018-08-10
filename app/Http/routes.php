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
    |These API end points are responsible for onboarding a user onto the Photogame app
    */
    //start sms verification routes
$api->get('validate-username/{q}', 'App\Http\Controllers\Auth\AuthController@checkUsername'); 
$api->get('validate-email/{q}', 'App\Http\Controllers\Auth\AuthController@checkEmail'); 
    //start user registration routes
$api->post('signup', 'App\Http\Controllers\Auth\AuthController@registerUser');  
$api->post('signin', 'App\Http\Controllers\Auth\AuthController@loginUser'); 
    //end user registration routes
    // photo routes
$api->post('post-photo','App\Http\Controllers\PhotoController@postPhoto');
$api->get('photos','App\Http\Controllers\PhotoController@getPhotos');
$api->get('photos/{id}','App\Http\Controllers\PhotoController@getPhoto');
$api->post('vote-photo','App\Http\Controllers\PhotoController@votePhoto');
$api->post('view-photo','App\Http\Controllers\PhotoController@viewPhoto');
    // photo routes
$api->post('signout', 'App\Http\Controllers\Auth\AuthController@signOut'); 
//END INAPP ROUTES

});

Route::get('/', function () {
    return view('welcome');
});
