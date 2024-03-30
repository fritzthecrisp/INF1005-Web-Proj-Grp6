<?php

namespace App\Controllers;

use App\Models\WorkoutModel;
use App\Models\InstanceSetModel;
use App\Models\InstanceModel;
use App\Models\CustomModel;

use function PHPSTORM_META\type;

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
        $db = db_connect();
        $model = new WorkoutModel($db);
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
        helper(['form']); //form validation


        $data = [
            'meta_title' => 'New Workout',
            'page_name' => 'Create New Workout'
        ];


        if ($this->request->is('post')) {
            $rules = [
                'workout_name' => 'required',
                'workout_description' => 'required',
                'sets' => 'required',
                'reps' => 'required',
            ];
            if ($this->validate($rules)) {
                # code...
                $db = db_connect();
                $db->transStart(); // start transaction
                try {
                    $instance_set_data = [];
                    // Insert data into the Workout table
                    $workout_model = new WorkoutModel($db);
                    $_POST['user_id']=5; // #user_id set dynamically
                    $workout_model->save($_POST);

                    // get the workout ID
                    $workout_id = $workout_model->db->insertID();

                    // Insert data into the instance table
                    $instance_model = new InstanceModel($db);
                    $instance_data = [
                        'workout_id' => $workout_id,
                        'user_id' => 5, // #userID #user_id find 
                    ];
                    $instance_model->insert($instance_data);

                    // get the instance ID
                    $instance_id = $instance_model->db->insertID();

                    //Insert data into the instance_set table
                    $instance_set_model = new InstanceSetModel($db);
                    foreach ($_POST['workoutOption'] as $i => $value) {
                        $instance_id = (int)$instance_id;
                        $exercise_id = (int)$value;
                        $instance_set_data[] = [
                            'instance_id' => $instance_id,
                            'exer_id' => $exercise_id,
                            'instance_set_count' => $_POST['sets'][$i],
                            'instance_set_reps' => $_POST['reps'][$i],
                            'instance_set_weight' => $_POST['weight'][$i]
                        ];
                    }

                    if (!empty($instance_set_data)) {
                        // Perform batch insertion using Model's insertBatch method
                        $instance_set_model->insertBatch($instance_set_data);
                    }

                    $db->transComplete(); // Commit transaction

                    $model = new CustomModel($db); //update the cache
                    $model->getPublicWorkouts();
                    $model = new InstanceModel($db); //update the cache
                    $model->fetchUserInstances();
                } catch (\Exception $e) {
                    $db->transRollback(); // Rollback transaction if any query fails
                    log_message('error', $e->getMessage()); // Logs the exception message
                    // Display a user-friendly error message
                    // You can set a flash message or render an error view
                    echo "An error occurred. Please try again later.";

                    // Handle exception or error here
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('add_workout', $data);
    }
    public function delete($id)
    {
        $db = db_connect();
        $model = new WorkoutModel($db);
        $instance = $model->find($id);
        if ($instance) {
            $model->delete($id);
            return redirect()->to('/myWorkout');;
        }
    }


    public function edit($id)
    {
        $db = db_connect();
        $model = new WorkoutModel($db);
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
            $model = new WorkoutModel($db);
            $_POST['workout_id'] = $id;

            $model->save($_POST);
            $instance = $model->find($id);
        }
        return view('edit_workout', $data);
    }
}
