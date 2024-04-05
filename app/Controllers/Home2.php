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


        $filtered_public_instances = []; // Initialize empty array to store filtered instances
        $count = 0; // Initialize counter
        
        foreach ($public_instances as $instance) {
            // Check if counter is less than 2
            if ($count < 2) {
                $filtered_public_instances[] = $instance; // Add instance to filtered array
                $count++; // Increment counter
            } else {
                break; // Exit loop once 2 instances are added
            }
        }
        

        return view('home', ['exercises' => $topExercises, 'workouts' => $filtered_public_instances, 'imgURLs' => $imgURLs]);
    }
    public function publicExercise()
    {
        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $cachedExercises = $cache->get('cached_exercises');
        $topExercises = $cache->get('top_exercises');
        $topWorkouts = $cache->get('top_workouts');
            $filtered_30_exercises = []; // Initialize empty array to store filtered instances

        // if cache is empty, add cache. 
        if ($topExercises === null) {
            $db = db_connect();
            if ($cachedExercises === null) { {
                    $model = new ExerciseModel($db);
                    $cachedExercises=$model->fetchExercises(); // since we won't need the cached exercises here, we won't return it. 
                }
            }
            if ($topExercises === null) { {
                    $model = new ExerciseModel($db);
                    $topExercises = $model->top5(); //  
                }
            }
            
    

        }
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github
            $count = 0; // Initialize counter
            
            foreach ($cachedExercises as $exercise) {
                // Check if counter is less than 2
                if ($count < 30) {
                    $filtered_30_exercises[] = $exercise; // Add instance to filtered array
                    $count++; // Increment counter
                } else {
                    break; // Exit loop once 2 instances are added
                }
            }



        return view('public_exercise', ['exercises' => $filtered_30_exercises, 'imgURLs' => $imgURLs]);
    }

    public function publicWorkout()
    {
        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        $db = db_connect();
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
