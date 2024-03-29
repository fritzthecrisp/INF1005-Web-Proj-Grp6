<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $exercises = [
            [
                'exer_id' => '1',
                'exer_name' => 'Exercise 1',
                'exer_equipment' => 'John Doe',
                'exer_level' => 'This is the description for Exercise 1.'
            ],
            [
                'exer_id' => '2',
                'exer_name' => 'Exercise 2',
                'exer_equipment' => 'Jane Smith',
                'exer_level' => 'This is the description for Exercise 2.'
            ],
            [
                'exer_id' => '3',
                'exer_name' => 'Exercise 3',
                'exer_equipment' => 'Alice Johnson',
                'exer_level' => 'This is the description for Exercise 3.'
            ],
            [
                'exer_id' => '4',
                'exer_name' => 'Exercise 4',
                'exer_equipment' => 'Alice Doe',
                'exer_level' => 'This is the description for Exercise 4.'
            ]
        ];

        $workouts = [
            [
                'workout_id' => '1',
                'workout_name' => 'Workout 1',
                'workout_description' => 'This is the description for Workout 1.'
            ],
            [
                'workout_id' => '2',
                'workout_name' => 'Workout 2',
                'workout_description' => 'This is the description for Workout 2.'
            ],
            [
                'workout_id' => '3',
                'workout_name' => 'Workout 3',
                'workout_description' => 'This is the description for Workout 3.'
            ],
            [
                'workout_id' => '4',
                'workout_name' => 'Workout 4',
                'workout_description' => 'This is the description for Workout 4.'
            ]
        ];

        // Pass the data to the view
        return view('home', ['exercises' => $exercises, 'workouts' => $workouts]);
    }
}
