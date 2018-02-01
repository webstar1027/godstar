<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
//use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin(Request $request,$driver)
    {
        if($request->isMethod('GET')){
            return Socialite::driver($driver)->redirect();
        }
        //dd(Socialite::driver($driver));

    }

//    public function socialLoginCallbackWeb($driver)
//    {
//        $user = Socialite::driver($driver)->user();
//        $user = User::firstOrCreate(['email'=>$user->getEmail()], ['name'=>$user->getName()]);
//        Auth::login($user);
//        return redirect('/home');
//    }

    public function socialLoginCallback(Request $request,$driver)
    {
        $user = Socialite::driver($driver)->user();
        $authUser = $this->findOrCreateUser($user, $driver);

        Auth::login($authUser, true);
        return redirect('/#!/user');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            $token = \JWTAuth::fromUser($authUser);
            return response()->json(['token' => $token]);
        }else{
            $authUser = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
        }
        $token = \JWTAuth::fromUser($authUser);
        return response()->json(['token' => $token]);
    }




    public function jwtAuth(Request $request)
    {
        $credentials = Input::only('email', 'password');
        $token = \JWTAuth::attempt($credentials);

        if(!$token){
             return response()->json(['error' => true]);
        }
        return response()->json(['token' => $token]);
    }

    public function signupJwt(Request $request)
    {
        $credentials = Input::only('email', 'password');
        $curr_email = $request->email;
        if(User::where('email',$curr_email)->first()){
            return response()->json(['error'=>'Email alredy exists!']);
        }
        $credentials['name']='User';
        $credentials['password']= bcrypt($credentials['password']);
        try {
            $user = User::create($credentials);
        } catch (Exception $e) {
            return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
        }

        $token = \JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function jwtRestricted()
    {
        try {
            \JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_UNAUTHORIZED);
        }

        return ['data' => 'This has come from a dedicated API subdomain with restricted access.'];
    }

    public function facebookLogin(Request $request)
    {
        $user['provider_id'] =  $request['fb'];
        $user['name'] =  $request['name'];
        $user['email'] =  $request['email'];
        $authUser = User::where('provider_id', $user['provider_id'])->first();
        if ($authUser) {
            $token = \JWTAuth::fromUser($authUser);
            return response()->json(['token' => $token]);
        }else{
            $authUser = User::create([
                'name'     => $user['name'],
                'email'     => $user['email'],
                'provider' => 'facebook',
                'provider_id' => $user['provider_id']
            ]);
        }
        $token = \JWTAuth::fromUser($authUser);
        return response()->json(['token' => $token]);
    }

    public function googleLogin(Request $request)
    {
        $user['provider_id'] =  $request['gid'];
        $user['name'] =  $request['name'];
        $user['email'] =  $request['email'];
        $authUser = User::where('provider_id', $user['provider_id'])->first();
        if ($authUser) {
            $token = \JWTAuth::fromUser($authUser);
            return response()->json(['token' => $token]);
        }else{
            $authUser = User::create([
                'name'     => $user['name'],
                'email'  => $user['email'],
                'provider' => 'google',
                'provider_id' => $user['provider_id']
            ]);
        }
        $token = \JWTAuth::fromUser($authUser);
        return response()->json(['token' => $token]);
    }

    public function linkedinLogin(Request $request)
    {
        $user['provider_id'] =  $request['lid'];
        $user['name'] =  $request['name'];
        $user['email'] =  $request['email'];
        $authUser = User::where('provider_id', $user['provider_id'])->first();
        if ($authUser) {
            $token = \JWTAuth::fromUser($authUser);
            return response()->json(['token' => $token]);
        }else{
            $authUser = User::create([
                'name'     => $user['name'],
                'email'     => $user['email'],
                'provider' => 'linkedin',
                'provider_id' => $user['provider_id']
            ]);
        }
        $token = \JWTAuth::fromUser($authUser);
        return response()->json(['token' => $token]);
    }

    public function takeToken()
    {
        try {
            \JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_UNAUTHORIZED);
        }
    }

    public function setFullName(Request $request)
    {
        if(\JWTAuth::parseToken()->toUser()){
            $user =  \JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
            die();
        }
        $id = $user['id'];
        DB::table('users')
            ->where('id', $id)
            ->update(['name' => $request->name]);
        return response()->json(['text' => true],200);
    }

}
