<?php

namespace App\Controllers;

use App\Models\InstanceModel;

class Instance extends BaseController
{
    public function index(): string
    {
        $data = [
            'meta_title' => 'My Workouts',
            'page_name' => 'My Workouts Page'
        ];
        return view('instance', $data);
    }
    public function selected(): string
    {
        $data = [
            'meta_title' => 'Push',
            'page_name' => 'Push Workout'
        ];
        return view('single_instance', $data);
    }
    public function new()
    {
        $data = [
            'meta_title' => 'New Workout',
            'page_name' => 'Create New Workout'
        ];
        if ($this->request->is('post')) {
            // what to run if they use post function
            $model = new InstanceModel();

            $model->save($_POST);
        }
        return view('new_instance', $data);
    }
}
