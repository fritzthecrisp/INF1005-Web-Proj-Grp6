<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Workouts extends BaseController
{
    public function index(): string
    {
        return view('workout');
    }

    protected function secret()
    {
        echo ' <h2>This text will never be visible. </h2>';
    }
}
