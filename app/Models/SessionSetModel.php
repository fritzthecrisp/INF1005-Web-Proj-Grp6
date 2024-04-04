<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class SessionSetModel extends Model
{
    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    protected $table    = 'session_sets';
    protected $primaryKey = 'session_set_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['session_id','session_exer_id', 'session_set_no', 'session_set_reps', 'session_set_weight'];

    // protected $useTimestamps = true;
    // protected $createdField = 'instance_created_at';
    // protected $updatedField = 'instance_updated_at';

    // protected $deletedField = 'instance_deleted_at';

    // protected $beforeInsert = ['checkName','getUserID']; // $beforeInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterInsert = ['checkName']; // $afterInsert is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeUpdate = ['checkName']; // $beforeUpdate is an event, and checkName is a function that runs when the event occurs. 
    // protected $beforeFind = ['checkName']; // $beforeFind is an event, and checkName is a function that runs when the event occurs. 
    // protected $afterDelete = ['checkName']; // $afterDelete is an event, and checkName is a function that runs when the event occurs. 
    


}
