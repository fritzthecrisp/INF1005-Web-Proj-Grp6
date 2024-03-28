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
    function all()
    {
        // "SELECT *  FROM exercises"
        $all_exercises = array();

        $exercises= $this->db->table('exercises')->get()->getResult();
        foreach ($exercises as $object) {
            $all_exercises[]= (array) $object;
        }

        return $all_exercises;
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

    function getWorkouts()
    {
        $user_id = 5; // here you will set the user ID
        $builder = $this->db->table('workouts');
        $builder->join('users', 'workouts.workout_creator = users.user_id AND users.user_id = ' . $user_id);
        $userworkouts = $builder->get()->getResult();
        return $userworkouts;
    }
}
