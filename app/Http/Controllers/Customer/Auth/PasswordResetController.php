<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    // Show the form to request a password reset link
    public function showLinkRequestForm()
    {
        return view('customer.auth.passwords.email');
    }

    // Handle sending the reset link email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('customers')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', __('A password reset link has been sent to your email address.'));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    // Show the reset form
    public function showResetForm($token)
    {
        return view('customer.auth.passwords.reset', ['token' => $token]);
    }

    // Handle the password reset
    public function reset(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'token' => 'required',
    ]);

    $status = Password::broker('customers')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($customer, $password) {
            $customer->forceFill([
                'password' => Hash::make($password),
            ])->save();

        }
    );

    if ($status === Password::PASSWORD_RESET) {
        return redirect()->route('Customer.login')->with('success', __('Your password has been reset successfully!'));
    }

    return back()->withErrors(['email' => [__($status)]]);
}

}
