<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function store()
    {
        return view('user.store');
    }

    public function story()
    {
        return view('user.story');
    }
}
