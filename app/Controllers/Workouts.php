<?php

namespace App\Controllers;

class Workouts extends BaseController
{
    public function index(): string
    {
        return view('workout');
    }

    public function workouts()
    {
        echo ' <h2>This is not Admin workoute Workouts funct </h2>';
    }


    protected function secret()
    {
        return view('workout');
    }
}
