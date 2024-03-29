<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\ExerciseModel;
use App\Models\WorkoutModel;
// use CodeIgniter\Config\Factories;


class API extends BaseController
{

    public function getExercises()
    {


        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $cachedExercises = $cache->get('cached_exercises');

        // if cache is empty, add cache. 
        if ($cachedExercises === null) {
            $db = db_connect();
            $model = new ExerciseModel($db);
            $model->fetchExercises(); // since we won't need the cached exercises here, we won't return it. 

        }

        // Convert the data to JSON format
        $jsonData = json_encode($cachedExercises);

        // Set the HTTP response headers to indicate JSON content
        header('Content-Type: application/json');

        // Output the JSON data
        echo $jsonData;

        // Exit the script
        exit;
    }
}
