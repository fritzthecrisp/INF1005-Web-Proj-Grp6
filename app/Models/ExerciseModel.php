<?php

namespace App\Models;

use CodeIgniter\Model;

class ExerciseModel extends Model
{
    protected $table = 'exercises'; 
    protected $primaryKey = 'id'; 

    // the table columns that we will allow users to change
    protected $allowedFields = ['exer_name', 'exer_equipment', 'exer_level']; 
    
    function fetchExercises()
    {
        // "SELECT *  FROM exercises"
        $all_exercises = array();

        $exercises= $this->db->table('exercises')->get()->getResult();
        foreach ($exercises as $object) {
            $all_exercises[]= (array) $object;
        }

        return $all_exercises;
    }

    
}