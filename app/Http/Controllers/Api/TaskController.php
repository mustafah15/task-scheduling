<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 1:57 PM
 */

namespace App\Http\Controllers\Api;

use App\Managers\TaskManager;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class TaskController extends BaseController
{

    protected  $manager ;

    public function __construct()
    {
        $this->manager = new TaskManager();
    }

    public function postCreateNew(Request $request)
    {
        $task['parent_id'] = $request->input('parent_id');
        $task['title'] = $request->input('title');

        return $this->manager->addNewTask($task);
    }

    public function getAllTasks()
    {
        return $this->manager->selectAllTasksByColumns();
    }

    public function postToDone(Request $request)
    {
          return $this->manager->changeToDone($request->input('task_id'));
    }

    public function postToInProgress(Request $request)
    {
        return $this->manager->changeToInProgress($request->input('task_id'));
    }

    public function getDependencies($id)
    {
        return $this->manager->getAllDependencies($id);
    }

    public function getAncestors($id)
    {
        return $this->manager->getTaskAncestors($id);
    }

}