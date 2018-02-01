<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/template', function () {
    return view('template');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/{driver}', 'Auth\RegisterController@redirectToProvider');
Route::get('/login', function(){
    return redirect('/administrate');
});
Route::get('/login/{driver}/callback', 'Auth\RegisterController@handleProviderCallback');
Route::post('/login/facebook/v1',['uses'=>'Auth\LoginController@facebookLogin']);
Route::post('/login/google/v1',['uses'=>'Auth\LoginController@googleLogin']);
Route::post('/login/linkedin/v1',['uses'=>'Auth\LoginController@linkedinLogin']);

Route::get('user',['before' => 'jwt-auth',function (Request $request) {
    try{
        return response()->json(['user' => JWTAuth::parseToken()->toUser()]);
    }catch (Exception $exception){
        return response()->json(['error' => $exception->getMessage()]);
    }
}]);

Route::prefix('administrate')->group(function () {
    Route::get('/', ['uses'=>'Admin\AdminController@login']);
    Route::get('/logout', ['uses'=>'Admin\AdminController@logout']);
    Route::get('/admin', ['uses'=>'Admin\AdminController@index']);
    Route::get('/user/{id}', ['uses'=>'Admin\AdminController@user'])->middleware('auth');
    Route::post('/login', ['uses'=>'Admin\AdminController@signin','as'=>'adminLogin']);
    Route::post('/actionDelete', ['uses'=>'Admin\AdminController@delete','as'=>'actionDelete'])->middleware('auth');
    Route::post('/actionArchive', ['uses'=>'Admin\AdminController@actionArchive','as'=>'actionArchive'])->middleware('auth');
    Route::post('/actionProspectDelete', ['uses'=>'Admin\AdminController@actionProspectDelete','as'=>'actionProspectDelete'])->middleware('auth');

    Route::post('/downloadResume', ['uses'=>'Admin\AdminController@downloadresume','as'=>'downloadResume'])->middleware('auth');

    Route::get('/archive', ['uses'=>'Admin\AdminController@archive']);
    Route::get('/prospects', ['uses'=>'Admin\AdminController@prospects']);
    Route::post('user/actionStatus', ['uses'=>'Admin\AdminController@actionStatus']);
    Route::get('/excel',
        [
            'uses' => 'Admin\AdminController@excel'
        ]);
//    Route::get('importExport', 'AdminController@importExport');
//    Route::get('downloadExcel/{type}', 'AdminController@downloadExcel');
//    Route::post('importExcel', 'AdminController@importExcel');
});
