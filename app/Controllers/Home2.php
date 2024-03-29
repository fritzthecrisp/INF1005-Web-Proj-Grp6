<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\ExerciseModel;
use App\Models\WorkoutModel;
// use CodeIgniter\Config\Factories;


class Home2 extends BaseController
{
    public function index()
    {

        $db = db_connect();
        $workoutsModel = new WorkoutModel();
        $exerciseModel = new ExerciseModel($db);
        $topExercises = $exerciseModel->top5();
        $workout = $workoutsModel->findAll();


        return view('home', ['exercises' => $topExercises, 'workouts' => $workout]);
    }
}
