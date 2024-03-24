<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Workout extends BaseController
{
    public function index()
    {
        return view('exerciseInfo');
    }

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

        // Pass exercise details to the view
        return view('workoutInfo', ['workout' => $workout]);
    }
}