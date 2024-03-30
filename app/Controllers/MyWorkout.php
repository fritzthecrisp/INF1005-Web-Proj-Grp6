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
        // get the cache for exercises. 
        $cache = \Config\Services::cache();
        $userID = 5; // #userID #user_id
        // check the cache 
        $user_workouts = $cache->get('user_instances_' . $userID);

        // if cache is empty, add cache. 
        if ($user_workouts === null) {
            $model = new InstanceModel($db);

            $user_workouts = $model->fetchUserInstances();
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
            'recommendedWorkouts' => $recommendedWorkouts
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
    public function addWorkout()
    {
        return view('add_workout');
    }
}
