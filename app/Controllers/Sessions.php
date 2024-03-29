<?php

namespace App\Controllers;

use App\Models\CustomModel;
use App\Models\ExerciseModel;

class Sessions extends BaseController
{
    public function index()
    {
        $cache = \Config\Services::cache();
        $cached_exercises = $cache->get('cached_exercises'); // Cache for 1 hour (3600 seconds)
        if ($cached_exercises === null) { {
                $db = db_connect();
                $model = new ExerciseModel($db);
                $result = $model->fetchExercises();
                echo '<pre>';
                print_r($result);
                echo '</pre>';
            }
        }else {
            echo'<h1>Your items are in the cache.</h1>';
        }
    }
    public function where()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->where();
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}
