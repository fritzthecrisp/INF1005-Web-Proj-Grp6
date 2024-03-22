<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login');
    }


    protected function secret()
    {
        return view('workout');
    }
}
