<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\InstanceModel;


class Home2 extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $exerciseModel = new CustomModel($db);
        $workoutsModel = new InstanceModel();

        $exercises = $exerciseModel->where();
        $workout = $workoutsModel->findAll();

        $topExercises = array();
        foreach ($exercises as $object) {
            $topExercises[]= (array) $object;
        }


        
        return view('home', ['exercises' => $topExercises, 'workouts' => $workout]);
    }
}
