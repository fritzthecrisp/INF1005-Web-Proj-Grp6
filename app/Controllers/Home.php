<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $exercises = [
            [
                'exercise_name' => 'Exercise 1',
                'made_by' => 'John Doe',
                'description' => 'This is the description for Exercise 1.'
            ],
            [
                'exercise_name' => 'Exercise 2',
                'made_by' => 'Jane Smith',
                'description' => 'This is the description for Exercise 2.'
            ],
            [
                'exercise_name' => 'Exercise 3',
                'made_by' => 'Alice Johnson',
                'description' => 'This is the description for Exercise 3.'
            ],
            [
                'exercise_name' => 'Exercise 4',
                'made_by' => 'Alice Doe',
                'description' => 'This is the description for Exercise 4.'
            ]
        ];

        $workouts = [
            [
                'workout_name' => 'Workout 1',
                'duration' => '30 minutes',
                'description' => 'This is the description for Workout 1.'
            ],
            [
                'workout_name' => 'Workout 2',
                'duration' => '45 minutes',
                'description' => 'This is the description for Workout 2.'
            ],
            [
                'workout_name' => 'Workout 3',
                'duration' => '60 minutes',
                'description' => 'This is the description for Workout 3.'
            ],
            [
                'workout_name' => 'Workout 4',
                'duration' => '75 minutes',
                'description' => 'This is the description for Workout 4.'
            ]
        ];

        // Pass the data to the view
        return view('home', ['exercises' => $exercises, 'workouts' => $workouts]);
    }
}
