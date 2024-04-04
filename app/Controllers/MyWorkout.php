<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\InstanceModel;

class MyWorkout extends BaseController
{
    public function index()
    {

        $db = db_connect();
        // get the cache for Public workouts. 
        $cache = \Config\Services::cache();

        // Get from session
        // Retrieve exercises from session
        $session = \Config\Services::session();
        $userID = $session->get('user_id'); // #userID #user_id
        //         $session->remove('user_instances_'.$userID);
        // $session->remove('user_instance_sets_'.$userID);


        // Check if the session variables exist
        if (!$session->has('user_instances_' . $userID)) {
            // If session data doesn't exist, fetch from the database
            $model = new InstanceModel($db);
            $user_workouts = $model->fetchUserInstances();
            $user_workouts = $user_workouts[0];
        } else {
            // If session data exists, retrieve it
            $user_workouts = $session->get('user_instances_' . $userID);
        }


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

        $data = [
            'myWorkouts' => $user_workouts,
            'recommendedWorkouts' => $public_instances,
            'imgURLs' => 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/' // set this string so all the images can be retrieved from the github

        ];

        // echo '<pre>';
        // print_r($user_workouts);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($recommendedWorkouts);
        // echo '</pre>';
        // exit;

        // // Pass the data to the view
        return view('my_workout', $data);
    }
}
