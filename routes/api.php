<?php

use Illuminate\Http\Request;
//use Tymon\JWTAuth\JWTAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get('/login/{driver}', 'Auth\LoginController@socialLogin');
//Route::get('/login/{driver}/callback', 'Auth\LoginController@socialLoginCallback');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',['before' => 'jwt-auth','uses'=>'Auth\LoginController@jwtAuth','as'=>'login']);
Route::post('signup',['before' => 'jwt-auth','uses'=>'Auth\LoginController@signupJwt','as'=>'signup']);

Route::post('take/token',['before' => 'jwt-auth','uses'=>'Auth\LoginController@takeToken']);

Route::get('/restricted',['uses'=>'Auth\LoginController@jwtRestricted']);

Route::get('user',['before' => 'jwt-auth',function (Request $request) {
    try{
        return response()->json(['user' => \JWTAuth::parseToken()->toUser()]);
    }catch (Exception $exception){
        return response()->json(['error' => $exception->getMessage()]);
    }
}]);

Route::post('upload',['uses'=>'UploadController@index']);

Route::post('linkedin/resume',['uses'=>'UploadController@linkedinResume']);
Route::post('/linkedin/resume/info',['uses'=>'UploadController@linkedinResumeSave']);
Route::post('/linkedin/resume/user',['uses'=>'UploadController@linkedinResumeSaveUser']);
Route::post('/linkedin/resume/get',['uses'=>'UploadController@linkedinResumeGet']);

Route::post('stripe',['uses'=>'StripeController@getTokenStripe', 'as' => 'pay']);

Route::post('fullname',['uses'=>'Auth\LoginController@setFullName']);

//Route::post('paypal',['uses'=>'PaypalController@getPaypalInfo']);
Route::post('stripe/plan',['uses'=>'StripeController@getPlanStripe']);

Route::post('/login/linkedin/v1',['uses'=>'Auth\LoginController@linkedinLogin']);
Route::post('/login/google/v1',['uses'=>'Auth\LoginController@googleLogin']);
Route::post('/login/facebook/v1',['uses'=>'Auth\LoginController@facebookLogin']);
Route::get('/login/{driver}', 'Auth\RegisterController@redirectToProvider');
Route::get('/login/{driver}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::post('domain/name', ['uses'=>'StripeController@domainName']);
Route::post('/domain/pay', ['uses'=>'StripeController@domainPay']);

Route::post('/templateid', ['uses'=>'UploadController@selectTemplate']);
