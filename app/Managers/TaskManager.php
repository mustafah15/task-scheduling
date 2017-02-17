<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 12:09 PM
 */

namespace App\Managers;


use App\Repositories\TaskRepository;

class TaskManager
{
    protected  $repository ;

    public function __construct()
    {
        $this->repository = new TaskRepository();
    }

    public function getAllTasks()
    {
       return $this->repository->getAll();
    }

    public function editTask($id,$data)
    {
        return $this->repository->editItem($data,$id);
    }

    public function selectAllTasksByColumns($columns)
    {
        return $this->repository->selectAllByColumns($columns);
    }

}