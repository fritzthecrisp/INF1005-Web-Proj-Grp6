<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\ExerciseModel;
use App\Models\InstanceModel;
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
            $cachedExercises = $model->fetchExercises(); // since we won't need the cached exercises here, we won't return it. 

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
    public function getUserInstanceSets($instance_id)
    {

        // Fetch exercise details based on the provided ID

        // Get from session
        // Retrieve exercises from session
        $session = \Config\Services::session();
        $userID = $session->get('user_id'); //set user ID
        // $session->remove('user_instances_'.$userID);
        // $session->remove('user_instance_sets_'.$userID);

        // Check if the session variables exist
        if (!$session->has('user_instances_' . $userID) || !$session->has('user_instance_sets_' . $userID)) {
            // If session data doesn't exist, fetch from the database
            $db = db_connect();
            $model = new InstanceModel($db);
            $result = $model->fetchUserInstances();
            $cachedUserInstances = $result[0];
            $cachedUserInstanceSets = $result[1];
        } else {
            // If session data exists, retrieve it
            $cachedUserInstances = $session->get('user_instances_' . $userID);
            $cachedUserInstanceSets = $session->get('user_instance_sets_' . $userID);
        }

        // Define a callback function to filter sets based on the instance ID
        $filterSets = function ($value) use ($instance_id) {
            return $value['instance_id'] == $instance_id;
        };

        // Use array_filter to filter sets based on the callback function
        $setDetails = array_filter($cachedUserInstanceSets, $filterSets);
        // Convert the data to JSON format
        $jsonData = json_encode($setDetails);

        // Set the HTTP response headers to indicate JSON content
        header('Content-Type: application/json');

        // Output the JSON data
        echo $jsonData;

        // Exit the script
        exit;
    }
}
