<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Mail\MailNotify;
use App\Mail\ResetPassword;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

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

    public function getLoginAdmin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        } else {
            return view('Admin.pages.login');
        }
    }

    public function postLoginAdmin(AdminLoginRequest $request)
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

    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        return Redirect::to('admin/login');
    }

    public function getLogin()
    {
        return view('Client.auth.login');
    }

    public function postLogin(Request $request)
    {
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::attempt($login)) {
            return redirect()->route('index');
        }
        return redirect()->back()->withInput()->withErrors('Email or Password wrong');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function getForgotPassword() {
        return view('Client.auth.forgot_password');
    }

    public function postForgotPassword(Request $request) {
        $email = $request->email;
        Mail::to($email)->send(new ResetPassword());
    }
}
