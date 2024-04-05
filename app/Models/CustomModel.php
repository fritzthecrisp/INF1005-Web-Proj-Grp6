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
    function fetchPublicWorkouts()
    {
        // "SELECT *  FROM instances"
        $sets_results = array();
        $all_my_sets = array();
        $all_my_instances = array();
        
        $session = \Config\Services::session();
        $userID = $session->get('user_id'); //set user ID


        
        $instances = $this->db->table('instances')
            ->select('instances.*, workouts.*, instance_sets.*, users.user_username, exercises.*') // Select columns from all tables
            ->join('workouts', 'instances.workout_id = workouts.workout_id') // Join with workouts table
            ->join('users', 'instances.user_id = users.user_id') // Join with users table
            ->join('instance_sets', 'instances.instance_id = instance_sets.instance_id') // Join with instance_sets table
            ->join('exercises', 'instance_sets.exer_id = exercises.exer_id') // Join with exercises table
            ->where('workout_public', 'Public') // Filter instances by Public
            // ->limit(2) // Limit the number of results to 5
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
                $image0 = $images[0];
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
                // 'instance_set_id' => $sets_results[$i]['instance_set_id'],
                'exer_name' => $sets_results[$i]['exer_name'],
                'exer_id' => $sets_results[$i]['exer_id'],
                'exer_image' => $image0,
                'sets' => $sets_results[$i]['instance_set_count'],
                'reps' => $sets_results[$i]['instance_set_reps'],
                'weight' => $sets_results[$i]['instance_set_weight']                // Add other fields if needed            ]
            ];

            $i++;
        }
        // echo '<pre>';
        // print_r($all_my_instances);
        // echo '</pre>';
        // // echo '<pre>';
        // // print_r($all_my_sets);
        // // echo '</pre>';
        // exit;


        // Cache the fetched exercises
        // $cache = \Config\Services::cache();
        // $cache->save('public_instance_sets', $all_my_sets, 3600); // Cache for 1 hour (3600 seconds)
        // $cache->save('public_instances', $all_my_instances, 3600); // Cache for 1 hour (3600 seconds)



        $result = [$all_my_instances, $all_my_sets];
        return $result;
    }

}



