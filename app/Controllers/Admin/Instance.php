<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Instance extends BaseController
{
    public function index()
    {
        echo ' <h2>A list of our user instance workouts</h2>';
    }

    public function createNew()
    {
        return view('instance_form');
    }

    
    public function saveInstance()
    {
        echo '<pre>';
        print_r($_POST);
        echo '<pre>';
        //return view('instance_form')
    }
}
