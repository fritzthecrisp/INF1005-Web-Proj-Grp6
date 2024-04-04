<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class WorkoutModel extends Model
{
    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    protected $table    = 'workouts';
    protected $primaryKey = 'workout_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['workout_name', 'workout_description', 'workout_public', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField = 'workout_created_at';
    protected $updatedField = 'workout_updated_at';

    // protected $deletedField = 'workout_deleted_at';

    // protected $beforeInsert = ['getUserID','checkName']; // $beforeInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterInsert = ['checkName']; // $afterInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeUpdate = ['checkName']; // $beforeUpdate is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeFind = ['checkName']; // $beforeFind is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterDelete = ['checkName']; // $afterDelete is an event, and checkName is a function that runs when the event occurs. 


    // public function checkName(array $data)
    // {
    //     $newTitle = $data['data']['workout_name'] . ' Extra Features';
    //     $data['data']['workout_name'] = $newTitle;
    //     return $data;
    // }
    // public function getUserID(array $data)
    // {
    //     // Log the contents of the $data variable
    //     log_message('debug', 'Contents of $data variable: ' . print_r($data, true));
    // $session = \Config\Services::session();
    // $userID = $session->get('user_id'); //set user ID
    //     $data['user_id'] = $userID;
    //     return $data;
    // }
    public function fetchTopWorkouts()
    {
        // "SELECT *  FROM workouts"
        $workouts = $this->db->table('workouts')
            ->select('instances.*, workouts.*, users.user_username') // Select columns from all tables
            ->join('instances', 'instances.workout_id = workouts.workout_id') // Join with instances table
            ->join('users', 'instances.user_id = users.user_id') // Join with users table
            ->where('workouts.workout_public', 'Public') // Corrected condition for filtering
            ->orderBy('workouts.workout_id', 'DESC') // Order by workout_id in descending order
            ->limit(5) // Limit the number of results to 5
            ->get()
            ->getResult();

        $top_workouts = array();
        foreach ($workouts as $object) {
            $top_workouts[] = (array) $object;
        }
        // Cache the fetched workouts
        $cache = \Config\Services::cache();
        $cache->save('top_workouts', $top_workouts, 3600); // Cache for 1 hour (3600 seconds)

        return $top_workouts;
    }
    public function fetchMyWorkouts()
    {
        // "SELECT *  FROM workouts"
        $workouts = $this->db->table('workouts')
            ->where(['workout_id >' => 5])
            ->where(['workout_id <=' => 10])
            ->orderBy('workout_id', 'DESC')
            ->get()
            ->getResult();

        $top_workouts = array();
        foreach ($workouts as $object) {
            $top_workouts[] = (array) $object;
        }
        // Cache the fetched workouts
        $cache = \Config\Services::cache();
        $cache->save('top_workouts', $top_workouts, 3600); // Cache for 1 hour (3600 seconds)

        return $top_workouts;
    }

    // public function create_instance(){
    //     $this->
    // }

    /// for the password hashing function, watch this video at 38:00 https://youtu.be/xO-vTpc-VJM?si=gFmSBl_tfVrhl1H7&t=2269

}
