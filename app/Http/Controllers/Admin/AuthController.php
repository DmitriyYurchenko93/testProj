<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function index() {
        return view('admin.auth.login');
    }

    public function loginAdmin (Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'string',],
            'password' => ['required'],
        ]);
        if (auth('admin')->attempt($data)){
            return redirect(route('admin.users.index'));
        }
        return redirect(route('admin.login'))->withErrors(['email' => 'email\пароль введены неверно']);
    }
    public function logoutAdmin() {
            auth('admin')->logout();
        return redirect(route('admin.login'));
    }
}
