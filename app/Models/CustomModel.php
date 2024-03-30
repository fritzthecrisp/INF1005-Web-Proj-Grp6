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
}



