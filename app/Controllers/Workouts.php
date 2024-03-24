<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Workouts extends BaseController
{
    public function index(): string
    {
        return view('workout');
    }

    public function workout($workout_name = 'Push 2', $workout_id = 'JN001')
    {
        echo ' <h2>This is workout called "'.$workout_name.'" by '.$workout_id.' </h2>';
    }


    protected function secret()
    {
        echo ' <h2>This text will never be visible. </h2>';
    }
}
