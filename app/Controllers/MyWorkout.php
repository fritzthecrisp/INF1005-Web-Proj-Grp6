<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MyWorkout extends BaseController
{
    public function index()
    {
        $myWorkouts = [
            [
                'id' => '1',
                'workout_name' => 'Workout 1',
                'made_by' => 'John Doe',
                'description' => 'This is the description for Exercise 1.'
            ],
            [
                'id' => '2',
                'workout_name' => 'Workout 2',
                'made_by' => 'Jane Smith',
                'description' => 'This is the description for Exercise 2.'
            ],
            [
                'id' => '3',
                'workout_name' => 'Workout 3',
                'made_by' => 'Alice Johnson',
                'description' => 'This is the description for Exercise 3.'
            ],
            [
                'id' => '4',
                'workout_name' => 'Workout 4',
                'made_by' => 'Alice Doe',
                'description' => 'This is the description for Exercise 4.'
            ]
        ];

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

        // Pass the data to the view
        return view('myWorkout', ['myWorkouts' => $myWorkouts, 'physicalTrainers' => $physicalTrainers,'recommendedWorkouts'=> $recommendedWorkouts]);
    }
    public function addWorkout()
    {
        return view('addWorkout');
    }
}
