<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $data[] = array(
                'id' => $task['id'],
                'title' => $task['name'],
                'start' => $task['start_at'],
                'end' => $task['end_at'],
            );
        }
        echo json_encode($data);
    }

    public function create(Request $request)
    {
        $task = new Task();
        if ($request->isPost()) {
            $body = $request->getBody();
            $task->loadData($body);
            if ($task->validate() && $task->register()) {
                redirect('/');
            }
            return $this->render('tasks/create-task', ['task' => $task]);
        }
        return $this->render('tasks/create-task');
    }

    public function edit(Request $request)
    {
        $params = $request->getBody();
        $task = Task::findOne(['id' => $params['id']]);
        if ($request->isPost()) {
            $task->loadData($params);
            if ($task->validate() && $task->update()) {
                redirect('/');
            }
            return $this->render('tasks/edit-task', ['task' => $task]);
        }
        return $this->render('tasks/edit-task', ['task' => $task]);
    }

    public function delete(Request $request)
    {
        $params = $request->getBody();
        $task = Task::findOne(['id' => $params['id']]);
        $task->delete();
        $_SESSION['DELETED'] = "Deleted task successfully";
        redirect('/');
    }
}