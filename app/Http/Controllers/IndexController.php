<?php

namespace App\Http\Controllers;


use App\Models\Operation;
use App\Models\UserCount;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function homeUser()
    {
        $user_id = auth('web')->user()->id;
        $userCount = UserCount::whereUserId($user_id)->first();
        $operations = Operation::whereSender($userCount->id)->get();
        return view('private', compact('userCount', 'operations'));
    }
}

