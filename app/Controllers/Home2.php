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

        // get the cache for exercises. 
        $cache = \Config\Services::cache();
        $cached_exercises = $cache->get('cached_exercises');
        if ($cached_exercises === null) { {
                $db = db_connect();
                $model = new ExerciseModel($db);
                $model->fetchExercises(); // since we won't need the cached exercises here, we won't need it. 
            }
        }


        return view('home', ['exercises' => $topExercises, 'workouts' => $workout]);
    }
}
