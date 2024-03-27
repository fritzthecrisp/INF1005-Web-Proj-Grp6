<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Exercise extends BaseController
{
    public function details($id)
    {
        // Fetch exercise details based on the provided ID
        // You can fetch details from a predefined array or database
        // For now, let's assume you have a predefined array of exercises
        $exercise = [
            'id' => $id,
            'exercise_name' => 'Exercise ' . $id, // Example exercise name
            'made_by' => 'John Doe', // Example creator name
            'description' => 'This is the description for Exercise ' . $id // Example description
        ];

        // Pass exercise details to the view
        return view('exercise_info', ['exercise' => $exercise]);
    }
}
