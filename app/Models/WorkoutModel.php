<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkoutModel extends Model
{

    protected $table    = 'workouts';
    protected $primaryKey = 'workout_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['workout_name', 'workout_description'];
    
    protected $useTimestamps = true;
    protected $createdField = 'workout_created_at';
    protected $updatedField = 'workout_updated_at';

    // protected $deletedField = 'workout_deleted_at';

    protected $beforeInsert = ['checkName','getUserID']; // $beforeInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterInsert = ['checkName']; // $afterInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeUpdate = ['checkName']; // $beforeUpdate is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeFind = ['checkName']; // $beforeFind is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterDelete = ['checkName']; // $afterDelete is an event, and checkName is a function that runs when the event occurs. 
    

    public function checkName( array $data){
        $newTitle = $data['data']['workout_name'].' Extra Features';
        $data['data']['workout_name'] = $newTitle;
        return $data;
    }
    public function getUserID(array $data){
        $userID = 5; //"Set user ID dynamically here"
        $data['data']['workout_creator'] = $userID;
        return $data;
    }

    // public function create_instance(){
    //     $this->
    // }

    /// for the password hashing function, watch this video at 38:00 https://youtu.be/xO-vTpc-VJM?si=gFmSBl_tfVrhl1H7&t=2269

}
