<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Replace with your database table name
    protected $allowedFields = [
        'user_username', 'user_fname', 'user_lname', 'user_email', 
        'user_password', 'user_dob', 'user_sex', 'user_weight', 'user_token', 'user_active', 'user_token_created_at'
    ];

    // Use entity class to auto-hash password
    protected $primaryKey = 'user_id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $createdField  = 'user_joindate';
    // protected $beforeInsert = ['hashPassword'];

    // protected function hashPassword(array $data)
    // {
    //     if (isset($data['data']['user_password'])) {
    //         $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_DEFAULT);
    //     }

    //     return $data;
    // }

    // protected function genToken($data) {
    //     if (isset($data['data']['user_token'])) {
    //         $token = bin2hex(random_bytes(32));
    //         $data['data']['user_token'] = $token;
    //     }

    //     return $data;
    // }
}