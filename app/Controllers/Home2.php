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
        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $cachedExercises = $cache->get('cached_exercises');
        $topExercises = $cache->get('top_exercises');
        $topWorkouts = $cache->get('top_workouts');

        // if cache is empty, add cache. 
        if ($cachedExercises === null or $topExercises === null or $topWorkouts === null) {
            $db = db_connect();
            if ($cachedExercises === null) { {
                    $model = new ExerciseModel($db);
                    $model->fetchExercises(); // since we won't need the cached exercises here, we won't return it. 
                }
            }
            if ($topExercises === null) { {
                    if ($model === null){
                    $model = new ExerciseModel($db);
                    }
                     $topExercises = $model->top5(); //  
                }
            }
            if ($topWorkouts === null) { {
                    $model = new WorkoutModel($db);
                    $topWorkouts= $model->fetchTopWorkouts(); // since we won't need the cached exercises here, we won't need it. 
                }
            }
        }


        return view('home', ['exercises' => $topExercises, 'workouts' => $topWorkouts]);
    }
}
