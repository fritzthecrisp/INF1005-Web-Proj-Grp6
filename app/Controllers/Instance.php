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

    public function details($id)
    {
        // Fetch exercise details based on the provided ID

        // // get the cache for exercises. 
        // $cache = \Config\Services::cache();

        // Get from session
        // Retrieve exercises from session
        $session = \Config\Services::session();
        $userID = $session->get('user_id'); //set user ID
        // $session->remove('user_instances_' . $userID);
        // $session->remove('user_instance_sets_' . $userID);
        // $session->remove('user_instance_sessions_' . $userID);

        // Check if the session variables exist
        if (!$session->has('user_instances_' . $userID) || !$session->has('user_instance_sets_' . $userID)) {
            // If session data doesn't exist, fetch from the database
            $db = db_connect();
            $model = new InstanceModel($db);
            $result = $model->fetchUserInstances();
            $cachedUserWorkoutSessions = $model->fetchUserWorkoutSessions();
            // echo '<pre>';
            // print_r($cachedUserWorkoutSessions);
            // echo '</pre>';
            // exit;

            $cachedUserInstances = $result[0];
            $cachedUserInstanceSets = $result[1];
        } else {
            // If session data exists, retrieve it
            $cachedUserInstances = $session->get('user_instances_' . $userID);
            $cachedUserInstanceSets = $session->get('user_instance_sets_' . $userID);
            $cachedUserWorkoutSessions = $session->get('user_instance_sessions_' . $userID);
        }
        // echo '<pre>';
        // print_r($cachedUserWorkoutSessions);
        // echo '</pre>';
        // exit;


        // Define a callback function to filter sets based on the instance ID
        $filterSets = function ($value) use ($id) {
            return $value['instance_id'] == $id;
        };

        // Use array_filter to filter sets based on the callback function
        $setDetails = array_filter($cachedUserInstanceSets, $filterSets);
        // // Use array_filter to filter sets based on the callback function
        // $sessionSetDetails = array_filter($cachedUserWorkoutSessions, $filterSets);
        $instance_sessions = [];
        // Check if the session ID exists in the array
        if (isset($cachedUserWorkoutSessions[$id])) {
            foreach ($cachedUserWorkoutSessions[$id] as $sessionID => $sessionInfo) {
                $createdTimestamp = strtotime($sessionInfo["session_date_created"]);
                $timeAgo = $this->getTimeAgo($createdTimestamp);
                $sessionInfo["session_date_created"] = $timeAgo;
                $instance_sessions[] = $sessionInfo;
            }
        }
        // echo '<pre>';
        // print_r($instance_sessions);
        // echo '</pre>';
        // exit;

        $workout = $cachedUserInstances[$id];
        // $isLoggedIn = $this->request->getCookie('isLoggedIn');
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github

        // Pass exercise details to the view
        return view('instance_info', ['workout' => $workout, 'sets' => $setDetails, 'imgURLs' => $imgURLs, 'sessionInfo' => $instance_sessions]);

        // return view('workout_info', ['workout' => $workout, 'isLoggedIn' => $isLoggedIn]);
    }
    public function new($id = null)
    {
        $workout = [];
        $setDetails = [];
        $session = \Config\Services::session();
        helper(['form']); //form validation
        $userID = $session->get('user_id');;



        if ($id !== null) {
            // Handle case when ID is provided

            /// Get the workout information. 
            // get the cache for exercises. 
            $cache = \Config\Services::cache();

            // check the cache 
            $public_instances = $cache->get('public_instances');
            $public_instance_sets = $cache->get('public_instance_sets');

            // if cache is empty, add cache. 
            if ($public_instance_sets === null || $public_instances === null) {
                $db = db_connect();
                $model = new CustomModel($db);

                $result = $model->fetchPublicWorkouts();
                $public_instances = $result[0];
                $public_instance_sets = $result[1];
            }

            $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github

            // Define a callback function to filter sets based on the instance ID
            $filterSets = function ($value) use ($id) {
                return $value['instance_id'] == $id;
            };


            // Use array_filter to filter sets based on the callback function
            $setDetails = array_filter($public_instance_sets, $filterSets);


            $workout = $public_instances[$id];
            if ($workout["workout_public"] === "Public") {
                $workout["checked"] = "checked";
            } else {
                $workout["checked"] = "";
            }
            $workout["disabled"] = "disabled";
            $workout["(d)"] = "<em>(disabled)</em>";
            // $isLoggedIn = $this->request->getCookie('isLoggedIn');


            $data = [
                'workout' => $workout,
                'sets' => $setDetails
            ];
        } else {
            $workout["checked"] = "";
            $workout["disabled"] = "";
            $workout["(d)"] = "";
            $workout["workout_name"] = "";
            $workout["workout_description"] = "";
            $setDetails = [];

            $data = [
                'workout' => $workout,
                'sets' => $setDetails,
                'meta_title' => 'New Workout',
                'page_name' => 'Create New Workout'
            ];

            // do nothing
        }


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
                    if ($id === null) {

                        $workout_model = new WorkoutModel($db);
                        $_POST['user_id'] = $session->get('user_id'); // #user_id set dynamically

                        if (isset($_POST["workout_public"])) {
                            if ($_POST["workout_public"] === "on") {
                                $_POST["workout_public"] = "Public";
                            } else {
                                $_POST["workout_public"] = "Private";
                            }
                        } else {
                            $_POST["workout_public"] = "Private";
                        }
                        $workout_model->save($_POST);
                        // get the workout ID
                        $workout_id = $workout_model->db->insertID();
                    }else {
                        $workout_id = $workout["workout_id"];
                    }

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

                    header("Location: https://35.212.145.3/myWorkout");
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
        $model = new InstanceModel($db);
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
                    if (isset($_POST["workout_public"])) {
                        if ($_POST["workout_public"] === "on") {
                            $_POST["workout_public"] = "Public";
                        } else {
                            $_POST["workout_public"] = "Private";
                        }
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
                    header("Location: https://35.212.145.3/myWorkout");
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
    protected function getTimeAgo($createdTimestamp)
    {
        // Get the current timestamp
        $currentTimestamp = time();

        // Calculate the difference in seconds
        $difference = $currentTimestamp - $createdTimestamp;

        // Calculate time units
        $minutes = floor($difference / 60);
        $hours = floor($difference / 3600);
        $days = floor($difference / 86400);
        $months = floor($difference / (86400 * 30));

        // Return time ago string based on the calculated units
        if ($minutes < 60) {
            return $minutes . " minutes ago";
        } elseif ($hours < 24) {
            return $hours . " hours ago";
        } elseif ($days < 30) {
            return $days . " days ago";
        } else {
            return $months . " months ago";
        }
    }
}
