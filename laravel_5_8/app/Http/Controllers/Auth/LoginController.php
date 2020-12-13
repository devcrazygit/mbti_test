<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
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
        // $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request){
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if(!$user){
            return response()->json([
                'status'    =>  'failed',
            ], 401);
        }
        if(!$user_token = JWTAuth::fromUser($user)){
            return response()->json([
                'status'    =>  'auth_failed',
            ], 401);
        }
        return response()->json([
            'access_token' =>  $user_token
        ]);
    }

}
