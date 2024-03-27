<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel
{

    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }


    function getWorkouts()
    {
        $user_id = 5; // here you will set the user ID
        $builder = $this->db->table('workouts');
        $builder->join('users','workouts.workout_creator = users.user_id AND users.user_id = '.$user_id);
        $userworkouts = $builder ->get()->getResult();
        return $userworkouts;
    }
} 
