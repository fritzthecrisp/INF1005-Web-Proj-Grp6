<?php

namespace App\Models;

use CodeIgniter\Model;

class InstanceModel extends Model
{

    protected $table    = 'workouts';
    protected $primaryKey = 'workout_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['workout_name', 'workout_description'];
}
