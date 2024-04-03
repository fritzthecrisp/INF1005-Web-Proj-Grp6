<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class InstanceModel extends Model
{

    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }


    protected $table    = 'instances';
    protected $primaryKey = 'instance_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['workout_id', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField = 'instance_created_at';
    protected $updatedField = 'instance_updated_at';

    // protected $deletedField = 'instance_deleted_at';

    // protected $beforeInsert = ['checkName','getUserID']; // $beforeInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterInsert = ['checkName']; // $afterInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeUpdate = ['checkName']; // $beforeUpdate is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeFind = ['checkName']; // $beforeFind is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterDelete = ['checkName']; // $afterDelete is an event, and checkName is a function that runs when the event occurs. 

    public function checkName(array $data)
    {
        $newTitle = $data['data']['instance_name'] . ' Extra Features';
        $data['data']['workout_name'] = $newTitle;
        return $data;
    }
    public function getUserID(array $data)
    {
        $userID = 5; //"Set user ID dynamically here"
        $data['data']['user_id'] = $userID;
        return $data;
    }

    function fetchUserInstances()
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
            ->where('instances.user_id', $userID) // Filter instances by user_id
            ->get()
            ->getResult();
        $i = 0;
        foreach ($instances as $object) {
            $sets_results[] = (array) $object; // contains every single set in all the users instances
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
                'instance_set_id' => $sets_results[$i]['instance_set_id'],
                'exer_name' => $sets_results[$i]['exer_name'],
                'exer_image' => $image0,
                'exer_equipment' => $sets_results[$i]['exer_equipment'],
                'exer_id' => $sets_results[$i]['exer_id'],
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


        // // Cache the fetched exercises
        // $cache = \Config\Services::cache();
        // $cache->save('user_instance_sets_' . $userID, $all_my_sets, 3600); // Cache for 1 hour (3600 seconds)
        // $cache->save('user_instances_' . $userID, $all_my_instances, 3600); // Cache for 1 hour (3600 seconds)

        // Add to session
        // Store the fetched exercises in session
        $session = \Config\Services::session();
        $userID = 5; // #userID #user_id

        // Set session variables
        $session->set('user_instance_sets_' . $userID, $all_my_sets);
        $session->set('user_instances_' . $userID, $all_my_instances);

        // Set session expiration (optional)
        $session->markAsTempdata('user_instance_sets_' . $userID, 3600); // Expire after 1 hour
        $session->markAsTempdata('user_instances_' . $userID, 3600); // Expire after 1 hour


        $result = [$all_my_instances, $all_my_sets];
        return $result;
    }


    /// for the password hashing function, watch this video at 38:00 https://youtu.be/xO-vTpc-VJM?si=gFmSBl_tfVrhl1H7&t=2269

}
