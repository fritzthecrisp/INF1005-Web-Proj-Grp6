<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Workouts extends BaseController
{
    public function index()
    {
        echo ' <h2>This is Admin Workouts areas </h2>';
    }

    public function workouts()
    {
        echo ' <h2>This is Admin workoute Workouts funct </h2>';
    }

    
    protected function secret()
    {
        return view('workout');
    }
}
