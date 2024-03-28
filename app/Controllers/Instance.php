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
    public function selected($id): string
    {
        $model = new InstanceModel();
        $instance = $model->find($id);
        if ($instance) {
            $data = [
                'meta_title' => $instance['workout_name'],
                'page_name' => $instance['workout_name'],
                'instance' => $instance,
            ];
        }else{
            $data = [
                'meta_title' => 'Post Not Found',
                'page_name' => 'Post Not Found',
            ];

        }
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
    public function delete($id)
    {
        $model = new InstanceModel();
        $instance = $model->find($id);
        if($instance) {
            $model->delete($id);
            return redirect()->to('/instance');
;        }
    }

    public function edit($id){
        $model = new InstanceModel();
        $instance = $model->find($id);
        $data = [
            'meta_title' => $instance['workout_name'],
            'page_name' => $instance['workout_name'],
        ];

        if ($this->request->is('post')) {
            // what to run if they use post function
            $model = new InstanceModel();
            $_POST['workout_id'] = $id;

            $model->save($_POST);
            $instance = $model->find($id);
        }
        $data['workout'] = $instance;
        return view ('edit_instance', $data);

    }

}
