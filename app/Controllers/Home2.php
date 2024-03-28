<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\InstanceModel;
use App\Models\WorkoutModel;


class Home2 extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $exerciseModel = new CustomModel($db);
        $workoutsModel = new WorkoutModel();

        $exercises = $exerciseModel->where();
        $workout = $workoutsModel->findAll();

        $topExercises = array();
        foreach ($exercises as $object) {
            $topExercises[]= (array) $object;
        }


        
        return view('home', ['exercises' => $topExercises, 'workouts' => $workout]);
    }
}
