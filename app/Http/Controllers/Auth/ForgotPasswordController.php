<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function getForgotPassword() {
        return view('Client.auth.forgot_password');
    }

    public function postForgotPassword(Request $request) {
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();

        if (!$checkUser) {
            return redirect()->route('getForgotPassword')->withErrors('Email không tồn tại');
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => bcrypt(time().$email),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

        try {
            Mail::to($email)->send(new ResetPassword($request->email, $tokenData->token));
        } catch (\Exception $e) {
            return redirect()->route('getForgotPassword')->withErrors('Có lỗi xảy ra khi gửi mail ');
        }

        return redirect()->back()->with('status', 'Link reset password đã được gửi đến email của bạn.');

    }
}
