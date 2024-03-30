<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InstanceModel;

class Workout extends BaseController
{
    public function details($id)
    {
        // Fetch exercise details based on the provided ID

        $userID = 5;
        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $cachedUserInstanceSets = $cache->get('user_instance_sets_' . $userID);
        $cachedUserInstances = $cache->get('user_instance_' . $userID);

        // if cache is empty, add cache. 
        if ($cachedUserInstances === null) {
            $db = db_connect();
            $model = new InstanceModel($db);
            $result = $model->fetchUserInstances();
            $cachedUserInstances = $result[0];
            $cachedUserInstanceSets = $result[1];
        }

        // You can fetch details from a predefined array or database
        // For now, let's assume you have a predefined array of exercises

        // Define a callback function to filter sets based on the instance ID
        $filterSets = function ($value) use ($id) {
            return $value['instance_id'] == $id;
        };

        // Use array_filter to filter sets based on the callback function
        $setDetails = array_filter($cachedUserInstanceSets, $filterSets);

        $workout = $cachedUserInstances[$id];
        // echo '<pre>';
        // print_r($setDetails);
        // echo '</pre>';
        // exit;
        // $isLoggedIn = $this->request->getCookie('isLoggedIn');
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github


        // Pass exercise details to the view
        return view('workout_info', ['workout' => $workout, 'sets' => $setDetails, 'imgURLs'=>$imgURLs]);

        // return view('workout_info', ['workout' => $workout, 'isLoggedIn' => $isLoggedIn]);
    }

    public function startWorkout($id)
    {
        // Fetch exercise details based on the provided ID
        // You can fetch details from a predefined array or database
        // For now, let's assume you have a predefined array of exercises
        $workout = [
            'id' => $id,
            'workout_name' => 'Workout ' . $id, // Example exercise name
            'made_by' => 'John Doe', // Example creator name
            'description' => 'This is the description for Exercise ' . $id // Example description
        ];

        // Pass exercise details to the view
        return view('start_workout', ['workout' => $workout]);
    }
}
