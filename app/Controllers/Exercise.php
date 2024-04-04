<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExerciseModel;

class Exercise extends BaseController
{
    public function details($id)
    {
        // Fetch exercise details based on the provided ID

        // // get the cache for exercises. 
        $cache = \Config\Services::cache();
        $exercisesArray = [];
        $result = $cache->get('cached_exercises');
        $instructions = "";
        if ($result === null) {
            $db = db_connect();
            $model = new ExerciseModel($db);
            $result = $model->fetchExercises();
        } else {
        }
        foreach ($result as $value) {
            $instructions = $value['exer_instructions'] . '"]';;

            // Decode the modified exer_instructions JSON string
            $decodedInstructions = json_decode($instructions);

            // Check if decoding was successful
            if ($decodedInstructions !== null) {
                // Update the exer_instructions field in the $value array
                $value['exer_instructions'] = $decodedInstructions;
            } else {
                // Handle JSON decoding error (if any)
                // You can log the error or handle it based on your application's requirements
            }
            $exercisesArray[$value['exer_id']] = $value;
        }
        // $workout = $cachedUserInstances[$id];
        // // $isLoggedIn = $this->request->getCookie('isLoggedIn');
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github


        // Pass exercise details to the view
        return view('exercise_info', ['exercise' => $exercisesArray[$id], 'imgURLs' => $imgURLs]);

        // return view('workout_info', ['workout' => $workout, 'isLoggedIn' => $isLoggedIn]);
    }
}
