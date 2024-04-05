<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [
        'user_username' => null,
        'user_fname' => null,
        'user_lname' => null,
        'user_email' => null,
        'user_password' => null,
        'user_dob' => null,
        'user_sex' => null,
        'user_weight' => null,
    ];

    protected $dates = ['user_joindate'];
}
?>
