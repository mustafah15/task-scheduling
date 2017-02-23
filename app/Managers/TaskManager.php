<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 12:09 PM
 */

namespace App\Managers;


use App\Repositories\TaskRepository;
use Yajra\Datatables\Datatables;
use App\Enums\Status;
class TaskManager
{
    protected  $repository ;

    public function __construct()
    {
        $this->repository = new TaskRepository();
    }

    public function addNewTask($data)
    {
        return $this->repository->createNew($data);
    }

    public function getAllTasks()
    {
       return $this->repository->getAll();
    }

    public function editTask($id,$data)
    {
        return $this->repository->editItem($data,$id);
    }

    public function changeToDone($id)
    {
       return $this->repository->editItem(['status'=>Status::Done], $id);
    }

    public function changeToInProgress($id)
    {
        return $this->repository->editItem(['status'=>Status::InProcess],$id);
    }

    public function selectAllTasksByColumns()
    {
        $tasks = $this->repository->selectAllByColumns(['id','parent_id','status','title','created_at','updated_at']);

        return Datatables::of($tasks)
            ->addColumn('action', function ($task) {
                if($task->status == Status::InProcess)
                    return '<a class="btn btn-xs btn-primary" onclick="done('.$task->id.')"><i class="glyphicon glyphicon-edit"></i> Mark as Done</a>';
                elseif ($task->status == Status::Done)
                    return '<a  class="btn btn-xs btn-danger" onclick="inprogress('.$task->id.')"><i class="glyphicon glyphicon-edit"></i> Mark as In progress</a>';
                elseif ($task->status == Status::Complete)
                    return 'Completed';
            })
            ->editColumn('status', function ($task){
                if ($task->status == Status::InProcess)
                    return "In progress";
                elseif ($task->status == Status::Done)
                    return 'Done';
                elseif ($task->status == Status::Complete)
                    return 'Complete';
            } )
            ->make(true);
    }

    function array_flatten($array) {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function getAllDependencies($task_id)
    {
        $data['items'] = $this->array_flatten($this->repository->getDependencies($task_id));
        $data['count'] = count($data['items']);
        return ($data);
    }

}