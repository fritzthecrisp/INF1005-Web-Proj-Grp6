<?php

namespace App\Models;

use CodeIgniter\Model;

class ExerciseModel extends Model
{
    protected $table = 'exercises'; 
    protected $primaryKey = 'id'; 

    // the table columns that we will allow users to change
    protected $allowedFields = ['exer_name', 'exer_equipment', 'exer_level']; 
    
    public function getFirst10Exercises()
    {
        
        return $this->limit(10)->get()->getResult();
    }
}