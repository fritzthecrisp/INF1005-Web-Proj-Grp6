<?php

namespace App\Controllers;

use App\Models\WorkoutModel;
use App\Models\InstanceModel;

class Instance extends BaseController
{
    public function index(): string
    {
        $data = [
            'meta_title' => 'My Workouts',
            'page_name' => 'My Workouts Page'
        ];
        return view('instance', $data);
    }
    public function selected($id): string
    {
        $model = new WorkoutModel();
        $instance = $model->find($id);
        if ($instance) {
            $data = [
                'meta_title' => $instance['workout_name'],
                'page_name' => $instance['workout_name'],
                'instance' => $instance,
            ];
        } else {
            $data = [
                'meta_title' => 'Post Not Found',
                'page_name' => 'Post Not Found',
            ];
        }
        return view('single_instance', $data);
    }
    public function new()
    {
        $data = [
            'meta_title' => 'New Workout',
            'page_name' => 'Create New Workout'
        ];
        if ($this->request->is('post')) {
            // what to run if they use post function
            $workout_model = new WorkoutModel();
            $workout_model->save($_POST);

            $workout_id = $workout_model->db->insertID();
            // Insert data into the instance table
            $instance_model = new InstanceModel();
            $instance_data = [
                'workout_id' => $workout_id,
                'user_id' => 5, // #userID #user_id find 
            ];
            $instance_model->insert($instance_data);
        }
        return view('add_workout', $data);
    }
    public function delete($id)
    {
        $model = new WorkoutModel();
        $instance = $model->find($id);
        if ($instance) {
            $model->delete($id);
            return redirect()->to('/instance');;
        }
    }

    // public function edit($id)
    // {
    //     $model = new WorkoutModel();
    //     $instance = $model->find($id);
    //     $data = [
    //         'meta_title' => $instance['workout_name'],
    //         'name' => $instance['workout_name'],
    //     ];

    //     if ($this->request->is('post')) {
    //         // what to run if they use post function
    //         $model = new WorkoutModel();
    //         $_POST['workout_id'] = $id;

    //         $model->save($_POST);
    //         $instance = $model->find($id);
    //     }
    //     $data['workout'] = $instance;
    //     return view('edit_instance', $data);
    // }

    // public function edit()
    // {
    //     $data['workout'] = [
    //         'id' => 1,
    //         'name' => 'Morning Routine',
    //         'description' => 'A quick morning workout to start the day energized.',
    //         'options' => ['Dumbbell' => true, 'Pushup' => false]
    //     ];

    //     return view('edit_workout', $data);
    // }
    
    public function edit($id)
    {
        $model = new WorkoutModel();
        $instance = $model->find($id);
        $data['workout'] = [
            'id' => $instance['workout_id'],
            'meta_title' => $instance['workout_name'],
            'name' => $instance['workout_name'],
            'description' => $instance['workout_description'],
            'options' => ['Dumbbell' => true, 'Pushup' => false]
        ];

        if ($this->request->is('post')) {
            // what to run if they use post function
            $model = new WorkoutModel();
            $_POST['workout_id'] = $id;

            $model->save($_POST);
            $instance = $model->find($id);
        }
        return view('edit_workout', $data);
    }
}
