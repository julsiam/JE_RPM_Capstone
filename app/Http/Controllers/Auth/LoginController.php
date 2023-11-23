<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     if ($user->type == 'tenant') {
    //         return redirect()->route('tenants.home');
    //     } elseif ($user->type == 'business_owner') {
    //         return redirect()->route('business_owner.owner_dashboard');
    //     }
    // }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
            'status' => 'Active',
        ];

        if (auth()->attempt($credentials)) {
            if (auth()->user()->type == 'business_owner') {
                return redirect()->route('business_owner.owner_dashboard');
            } else {
                return redirect()->route('tenants.home');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials! Try again');
        }



        // if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        // {
        //     if (auth()->user()->type == 'business_owner') {
        //         return redirect()->route('business_owner.owner_dashboard');

        //     }else{
        //         return redirect()->route('tenants.home');
        //     }
        // }else{
        //     return redirect()->route('login')->with('error', 'Invalid Credentials! Try again');
        // }

    }
}
