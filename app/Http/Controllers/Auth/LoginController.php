<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('Admin.pages.login');
    }

    public function postLogin(AdminLoginRequest $request)
    {
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::attempt($login)) {
            if (Auth::user()->role == User::ROLE_ADMIN || Auth::user()->role == User::ROLE_MANAGEMENT) {
                return redirect()->route('admin.index');
            } else {
//                return redirect()->route('home');
            }
        }
        return redirect()->back()->withInput()->withErrors('Email or Password wrong');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.getLogin');
    }
}
