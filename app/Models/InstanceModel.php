<?php

namespace App\Models;

use CodeIgniter\Model;

class instanceModel extends Model
{

    protected $table    = 'posts';
    protected $primaryKey = 'post_id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['instance_title', 'instance_description'];
}
