<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class SessionModel extends Model
{
    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    protected $table    = 'instance_sessions';
    protected $primaryKey = 'session_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['instance_id'];

    protected $useTimestamps = true;
    protected $createdField = 'session_date_created';
    protected $updatedField = 'session_date_updated';

}
