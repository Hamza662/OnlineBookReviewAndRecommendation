<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    // Forgot password form dikhane ke liye
    public function showForm()
    {
        return view('auth.forgot-password');
    }
    // Reset link bhejne ke liye
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'Reset link have been send!'])
                    : back()->withErrors(['email' => 'Not found email.']);
    }

     // Reset form dikhane ke liye
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Password reset karne ke liye
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('account.login')->with('status', 'Password reset have done!')
                    : back()->withErrors(['email' => 'Something went wrong.']);
    }
}
