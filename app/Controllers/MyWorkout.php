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
        $userID = 5; // #userID #user_id

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

        $physicalTrainers = [
            [
                'id' => '1',
                'workout_name' => 'Workout 1',
                'made_by' => '30 minutes',
                'description' => 'This is the description for Workout 1.'
            ],
            [
                'id' => '2',
                'workout_name' => 'Workout 2',
                'made_by' => '45 minutes',
                'description' => 'This is the description for Workout 2.'
            ],
            [
                'id' => '3',
                'workout_name' => 'Workout 3',
                'made_by' => '60 minutes',
                'description' => 'This is the description for Workout 3.'
            ],
            [
                'id' => '4',
                'workout_name' => 'Workout 4',
                'made_by' => '75 minutes',
                'description' => 'This is the description for Workout 4.'
            ]
        ];

        // check the cache 
        $recommendedWorkouts = $cache->get('public_workouts');

        // if cache is empty, add cache. 
        if ($recommendedWorkouts === null) {
            $model = new CustomModel($db);

            $recommendedWorkouts = $model->getPublicWorkouts();
        }

        $data = [
            'myWorkouts' => $user_workouts,
            'physicalTrainers' => $physicalTrainers,
            'recommendedWorkouts' => $recommendedWorkouts,
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
