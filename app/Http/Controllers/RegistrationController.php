<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCount;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration.registration');
    }

    public function regUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
        ]);
         $user = User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => bcrypt($data['password']),
         ]);
         if ($user) {
             $client = User::whereEmail($data['email'])->first();
             $user_count = new UserCount();
             $user_count->user_id = $client->id;
             $user_count->user_email = $client->email;
             $user_count->save();
             auth('web')->login($user);
         }
         return redirect(route('home.user'));
    }
}
