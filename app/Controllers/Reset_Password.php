<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Reset_Password extends BaseController
{
    public function index()
    {
        return view('reset_password');
    }

    // protected function secret()
    // {
    //     return view('workout');
    // }
}
