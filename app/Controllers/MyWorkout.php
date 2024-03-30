<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class MyWorkout extends BaseController
{
    public function index()
    {

        // get the cache for exercises. 
        $cache = \Config\Services::cache();

        // check the cache 
        $myWorkouts = $cache->get('my_workouts');

        // if cache is empty, add cache. 
        if ($myWorkouts === null) {
            $db = db_connect();
            $model = new CustomModel($db);

            $myWorkouts = $model->getWorkouts();
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

        $recommendedWorkouts = [
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
        $data = [
            'myWorkouts' => $myWorkouts,
            'physicalTrainers' => $physicalTrainers,
            'recommendedWorkouts' => $recommendedWorkouts
        ];

        // // Pass the data to the view
        return view('my_workout', $data);
    }
    public function addWorkout()
    {
        return view('add_workout');
    }
}
