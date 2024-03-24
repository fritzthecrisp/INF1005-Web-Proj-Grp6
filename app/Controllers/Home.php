<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExerciseModel;
use App\Models\InstanceModel;


class Home extends BaseController
{
    public function index()
    {
        $exerciseModel = new ExerciseModel();
        $workoutsModel = new InstanceModel();

        $exercises = $exerciseModel->getFirst6Exercises();
        $workout = $workoutsModel->findAll();
        
        return view('home', ['exercises' => $exercises, 'workouts' => $workout]);
    }
}
