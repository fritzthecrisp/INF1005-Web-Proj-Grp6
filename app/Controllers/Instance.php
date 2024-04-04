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
        $session = \Config\Services::session();
        
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
        $session = \Config\Services::session();
        helper(['form']); //form validation
        $userID= $session->get('user_id');; 

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
                    $_POST['user_id'] = $session->get('user_id'); // #user_id set dynamically
                    if ($_POST["workout_public"] === "on") {
                        $_POST["workout_public"] = "Public";
                    } else {
                        $_POST["workout_public"] = "Private";
                    }

                    $workout_model->save($_POST);

                    // get the workout ID
                    $workout_id = $workout_model->db->insertID();

                    // Insert data into the instance table
                    $instance_model = new InstanceModel($db);
                    $instance_data = [
                        'workout_id' => $workout_id,
                        'user_id' => $session->get('user_id'), // #userID #user_id find 
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
                    $model->fetchPublicWorkouts();
                    $model = new InstanceModel($db); //update the cache
                    $model->fetchUserInstances();

                    header("Location: http://localhost/myWorkout");
                    exit();
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
        helper(['form']); //form validation
        $session = \Config\Services::session();
        $userID = $session->get('user_id');; //set user ID because you cannot edit items that aren't owned by you.
        // // get the cache for exercises. 
        // $cache = \Config\Services::cache();

        // Get from session
        // Retrieve exercises from session
        $session = \Config\Services::session();
        // $session->remove('user_instances_' . $userID);
        // $session->remove('user_instance_sets_' . $userID);

        // Check if the session variables exist
        if (!$session->has('user_instances_' . $userID) || !$session->has('user_instance_sets_' . $userID)) {
            // If session data doesn't exist, fetch from the database
            $db = db_connect();
            $model = new InstanceModel($db);
            $result = $model->fetchUserInstances();
            $cachedUserInstances = $result[0];
            $cachedUserInstanceSets = $result[1];
        } else {
            // If session data exists, retrieve it
            $cachedUserInstances = $session->get('user_instances_' . $userID);
            $cachedUserInstanceSets = $session->get('user_instance_sets_' . $userID);
        }

        // Define a callback function to filter sets based on the instance ID
        $filterSets = function ($value) use ($id) {
            return $value['instance_id'] == $id;
        };
        // Use array_filter to filter sets based on the callback function
        $setDetails = array_filter($cachedUserInstanceSets, $filterSets);

        $workout = $cachedUserInstances[$id];
        if ($workout["workout_public"] === "Public") {
            $workout["checked"] = "checked";
        } else {
            $workout["checked"] = "";
        }
        // $isLoggedIn = $this->request->getCookie('isLoggedIn');
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github


        $data = [
            'workout' => $workout,
            'sets' => $setDetails,
            'imgURLs' => $imgURLs
        ];

        if ($this->request->is('post')) {

            // get the workout ID
            $workout_id = $workout['workout_id'];
            // get the instance ID
            $instance_id = $workout['instance_id'];
            // get the instance_set_IDs,
            $instance_set_ids = [];
            foreach ($setDetails as $setDetail) {
                $instance_set_ids[] = $setDetail['instance_set_id'];
            }
            // $array=[1,2,3];


            // what to run if they use post function
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
                    $_POST['user_id'] = $userID; // #user_id set dynamically
                    $_POST['workout_id'] = $workout_id;
                    if ($_POST["workout_public"] === "on") {
                        $_POST["workout_public"] = "Public";
                    } else {
                        $_POST["workout_public"] = "Private";
                    }

                    $workout_model->save($_POST);

                    // Insert data into the instance table
                    $instance_model = new InstanceModel($db);
                    $instance_data = [
                        'workout_id' => $workout_id,
                        'user_id' => $userID, // #userID #user_id find 
                        'instance_id' => $instance_id
                    ];
                    $instance_model->save($instance_data);


                    //Insert data into the instance_set table
                    $instance_set_model = new InstanceSetModel($db);
                    foreach ($instance_set_ids as $set_id) {
                        $instance_set_model->delete((int)$set_id);
                    }

                    // $instance_set_model->delete($instance_set_ids);


                    foreach ($_POST['workoutOption'] as $i => $value) {
                        $instance_id = (int)$instance_id;
                        $exercise_id = (int)$value;
                        // If exercise ID does not exist, skip adding instance set ID
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
                    $model->fetchPublicWorkouts();
                    $model = new InstanceModel($db); //update the cache
                    $model->fetchUserInstances();
                    header("Location: http://localhost/myWorkout");
                    exit();
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

        return view('edit_instance', $data);
    }
}
