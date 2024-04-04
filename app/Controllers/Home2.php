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
        // $topWorkouts = $cache->get('top_workouts');
        // check the cache 
        $public_instances = $cache->get('public_instances');
        $public_instance_sets = $cache->get('public_instance_sets');

        // if cache is empty, add cache. 
        if ($cachedExercises === null or $topExercises === null or $public_instances === null) {
            $db = db_connect();
            if ($cachedExercises === null) { {
                    $model = new ExerciseModel($db);
                    $model->fetchExercises(); // since we won't need the cached exercises here, we won't return it. 
                }
            }
            if ($topExercises === null) { {
                    $model = new ExerciseModel($db);
                    $topExercises = $model->top5(); //  
                }
            }

            // if cache is empty, add cache. 
            if ($public_instance_sets === null || $public_instances === null) {
                $model = new CustomModel($db);

                $result = $model->fetchPublicWorkouts();
                $public_instances = $result[0];
                $public_instance_sets = $result[1];
            }
        }
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github



        return view('home', ['exercises' => $topExercises, 'workouts' => $public_instances, 'imgURLs' => $imgURLs]);
    }
    public function publicExercise()
    {
        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $cachedExercises = $cache->get('cached_exercises');
        $topExercises = $cache->get('top_exercises');
        $topWorkouts = $cache->get('top_workouts');

        // if cache is empty, add cache. 
        if ($topExercises === null) {
            $db = db_connect();
            if ($cachedExercises === null) { {
                    $model = new ExerciseModel($db);
                    $model->fetchExercises(); // since we won't need the cached exercises here, we won't return it. 
                }
            }
            if ($topExercises === null) { {
                    $model = new ExerciseModel($db);
                    $topExercises = $model->top5(); //  
                }
            }
        }
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github



        return view('public_exercise', ['exercises' => $topExercises, 'imgURLs' => $imgURLs]);
    }

    public function publicWorkout()
    {
        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $cachedExercises = $cache->get('cached_exercises');
        $topExercises = $cache->get('top_exercises');
        $topWorkouts = $cache->get('top_workouts');

        // check the cache 
        $public_instances = $cache->get('public_instances');
        $public_instance_sets = $cache->get('public_instance_sets');

        // if cache is empty, add cache. 
        if ($public_instance_sets === null || $public_instances === null) {
            $model = new CustomModel($db);

            $result = $model->fetchPublicWorkouts();
            $public_instances = $result[0];
            $public_instance_sets = $result[1];
        }
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github



        return view('public_workout', ['workouts' => $public_instances, 'imgURLs' => $imgURLs]);
    }
}
