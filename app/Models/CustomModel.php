<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel
{

    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }
    function where()
    {
        // "SELECT *  FROM exercises"
        return $this->db->table('exercises')
            ->where(['exer_id >' => 5])
            ->where(['exer_id <=' => 10])
            ->orderBy('exer_id', 'DESC')
            ->get()
            ->getResult();
    }

    function getPublicWorkouts()
    {
        $cache = \Config\Services::cache();
        $user_id = 5; // here you will set the user ID
        

        $builder = $this->db->table('workouts');
        $builder->join('users', 'workouts.user_id = users.user_id AND users.user_id = ' . $user_id);
        $workout_results = $builder->where('workout_public', 'Public')->get()->getResult();        
        
        
        $public_workouts = array();
        foreach ($workout_results as $object) {
            $public_workouts[] = (array) $object;
        }



        // Cache the fetched exercises
        $cache->save('public_workouts', $public_workouts, 3600); // Cache for 1 hour (3600 seconds)
        return $public_workouts;
    }

    function fetchPublicWorkouts()
    {
        // "SELECT *  FROM instances"
        $sets_results = array();
        $all_my_sets = array();
        $all_my_instances = array();
        $userID = 5; //set user ID

        $instances = $this->db->table('instances')
            ->select('instances.*, workouts.*, instance_sets.*, users.user_username, exercises.*') // Select columns from all tables
            ->join('workouts', 'instances.workout_id = workouts.workout_id') // Join with workouts table
            ->join('users', 'instances.user_id = users.user_id') // Join with users table
            ->join('instance_sets', 'instances.instance_id = instance_sets.instance_id') // Join with instance_sets table
            ->join('exercises', 'instance_sets.exer_id = exercises.exer_id') // Join with exercises table
            ->where('workout_public', 'Public') // Filter instances by Public
            ->get()
            ->getResult();
        $i = 0;
        foreach ($instances as $object) {
            $sets_results[] = (array) $object; // contains every single set in public instances
            $instance_id = $sets_results[$i]["instance_id"];

            // Extract and assign workout image
            $images = json_decode($sets_results[$i]["exer_images"], true);
            if (!empty($images)) {
                $image1 = $images[1];
            }

            if (!isset($all_my_instances[$instance_id])) {
                $all_my_instances[$instance_id] = [
                    'workout_id' => $sets_results[$i]['workout_id'],
                    'user_name' => $sets_results[$i]['user_username'],
                    'instance_id' => $sets_results[$i]['instance_id'],
                    'workout_image' => $image1,
                    'workout_name' => $sets_results[$i]['workout_name'],
                    'workout_description' => $sets_results[$i]['workout_description'],
                    'workout_public' => $sets_results[$i]['workout_public']
                    // Add other fields if needed            ]
                ];
            }

            $all_my_sets[] = [
                'instance_id' => $sets_results[$i]['instance_id'],
                'exer_name' => $sets_results[$i]['exer_name'],
                'sets' => $sets_results[$i]['instance_set_count'],
                'reps' => $sets_results[$i]['instance_set_reps'],
                'weight' => $sets_results[$i]['instance_set_weight']                // Add other fields if needed            ]
            ];

            $i++;
        }
        // echo '<pre>';
        // print_r($all_my_instances);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($all_my_sets);
        // echo '</pre>';
        // exit;


        // Cache the fetched exercises
        $cache = \Config\Services::cache();
        $cache->save('public_instance_sets', $all_my_sets, 3600); // Cache for 1 hour (3600 seconds)
        $cache->save('public_instances', $all_my_instances, 3600); // Cache for 1 hour (3600 seconds)



        $result = [$all_my_instances, $all_my_sets];
        return $result;
    }

}



