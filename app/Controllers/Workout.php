<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InstanceModel;
use App\Models\CustomModel;
use App\Models\SessionModel;
use App\Models\SessionSetModel;

class Workout extends BaseController
{
    public function details($id)
    {
        // Fetch exercise details based on the provided ID

        $userID = 5;
        // // get the cache for exercises. 
        // $cache = \Config\Services::cache();

        // Get from session
        // Retrieve exercises from session
        $session = \Config\Services::session();
        $userID = 5; // #userID #user_id
        // $session->remove('user_instances_' . $userID);
        // $session->remove('user_instance_sets_' . $userID);

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
        return view('workout_info', ['workout' => $workout, 'sets' => $setDetails, 'imgURLs' => $imgURLs, 'sessionInfo' => $instance_sessions]);

        // return view('workout_info', ['workout' => $workout, 'isLoggedIn' => $isLoggedIn]);
    }

    public function start($id)
    {
        // Fetch exercise details based on the provided ID
        $userID = 5;
        // Get from session
        // Retrieve exercises from session
        $session = \Config\Services::session();
        $userID = 5; // #userID #user_id
        // $session->remove('user_instances_'.$userID);
        // $session->remove('user_instance_sets_'.$userID);

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
        $imgURLs = 'https://raw.githubusercontent.com/yuhonas/free-exercise-db/main/exercises/'; // set this string so all the images can be retrieved from the github
        $instance_id = $workout['instance_id'];
        $session_set_data = [];
        if ($this->request->is('post')) {
            $rules = [
                'set_reps' => 'required',
                // 'set_weight' => 'required',
                // 'sets' => 'required',
                // 'reps' => 'required',
            ];
            if ($this->validate($rules)) {
                # code...
                $db = db_connect();
                $db->transStart(); // start transaction
                try {
                    // Insert data into the Instance Sessions table
                    $session_model = new SessionModel($db);
                    $session_model->save(['instance_id' => $instance_id]);
                    // get the session ID
                    $session_id = $session_model->db->insertID();
                    // $session_id = 1;

                    //Insert data into the instance_set table
                    $session_set_model = new SessionSetModel($db);
                    foreach ($_POST['set_reps'] as $i => $value) {
                        $exercise_id = (int)$i;
                        foreach ($value as $setNumber => $repCount) {
                            if ($repCount > 0) {
                                $repWeight = $_POST['set_weight'][$exercise_id][$setNumber];
                                $repWeight = $repWeight ?: 0;
                                $session_set_data[] = [
                                    'session_id' => $session_id,
                                    'session_exer_id' => $exercise_id,
                                    'session_set_no' => $setNumber,
                                    'session_set_reps' => $repCount,
                                    'session_set_weight' => $repWeight
                                ];
                            }
                        }
                    }



                    if (!empty($session_set_data)) {
                        // Perform batch insertion using Model's insertBatch method
                        $session_set_model->insertBatch($session_set_data);
                    }
                    // echo '<pre>';
                    // print_r($session_set_model->db->insertID());
                    // echo '</pre>';
                    // exit;

                    $db->transComplete(); // Commit transaction

                    $model = new CustomModel($db); //update the cache
                    $model->fetchPublicWorkouts();
                    $model = new InstanceModel($db); //update the cache
                    $model->fetchUserInstances();

                    // header("Location: http://localhost/myWorkout");
                    // exit();
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




        // Pass exercise details to the view
        return view('workout_session', ['workout' => $workout, 'sets' => $setDetails, 'imgURLs' => $imgURLs, 'POST' => $session_set_data]);
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
