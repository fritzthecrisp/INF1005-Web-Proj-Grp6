<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Workout extends BaseController
{
    public function details($id)
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
        // $isLoggedIn = $this->request->getCookie('isLoggedIn');

        // Pass exercise details to the view
        return view('workout_info', ['workout' => $workout]);

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