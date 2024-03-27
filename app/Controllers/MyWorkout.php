<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class MyWorkout extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $model = new CustomModel($db);

        $model->getWorkouts();
        $myWorkoutsObjects=$model->getWorkouts();
        $myWorkouts = array();
        foreach ($myWorkoutsObjects as $object) {
            $myWorkouts[]= (array) $object;
        }


        // $myWorkouts = [
        //     [
        //         'workout_id' => '1',
        //         'workout_name' => 'Workout 1',
        //         'workout_creator' => 'John Doe',
        //         'workout_description' => 'This is the description for Exercise 1.'
        //     ],
        //     [
        //         'workout_id' => '2',
        //         'workout_name' => 'Workout 2',
        //         'workout_creator' => 'Jane Smith',
        //         'workout_description' => 'This is the description for Exercise 2.'
        //     ],
        //     [
        //         'workout_id' => '3',
        //         'workout_name' => 'Workout 3',
        //         'workout_creator' => 'Alice Johnson',
        //         'workout_description' => 'This is the description for Exercise 3.'
        //     ],
        //     [
        //         'workout_id' => '4',
        //         'workout_name' => 'Workout 4',
        //         'workout_creator' => 'Alice Doe',
        //         'workout_description' => 'This is the description for Exercise 4.'
        //     ]
        // ];
        // echo '<pre>';
        // print_r($myWorkouts);
        // echo '</pre>';

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
        return view('myWorkout', $data);
    }
    public function addWorkout()
    {
        return view('addWorkout');
    }
}
