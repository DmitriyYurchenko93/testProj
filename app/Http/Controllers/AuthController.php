<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function showForgotForm() {
        return view('auth.forgot');
    }

    public function loginUser (Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'string',],
            'password' => ['required'],
        ]);
        if (auth('web')->attempt($data)){
            return redirect(route('home.user'));
        }
        return redirect(route('login'))->withErrors(['email' => 'email\пароль введены неверно']);
    }

    public function logout() {
        auth('web')->logout();
        return redirect(route('home'));
    }

    public function forgotPass(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'string', 'exists:users']
        ]);

        $user = User::whereEmail($data['email'])->first();

        $password = uniqid();
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new ForgotPassword($password));
        return redirect(route('login'));
    }
}
