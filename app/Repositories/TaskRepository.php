<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 11:31 AM
 */

namespace App\Repositories;


use App\Task;

class TaskRepository extends RepositoryBase implements RepositoryContract
{
    public function __construct()
    {
        $this->db_connection = new Task();
    }

    public function checkDependencies($task_id)
    {
        return $this->db_connection->where('parent_id','=',$task_id)->first();
    }

    public function getDependencies($task_id, $children = [])
    {

        $tasks = $this->db_connection->where('parent_id','=',$task_id)
            ->get(['id','status']);

        foreach ($tasks as $task)
        {
            $children[] = $this->getDependencies($task->id,[$task]);
        }

        return $children;
    }

    public function getAncestors($id, $ancestors = [])
    {
        $parent_id = $this->db_connection->find($id)->parent_id;

        if ($parent_id == 0 )
            return $ancestors;
        else {
            $parent = $this->db_connection
                ->where('id', '=', $parent_id)
                ->get(['id', 'status', 'parent_id'])->first();

            $ancestors[] = $this->getAncestors($parent->id,[$parent]);
            return $ancestors;
        }
    }

    public function getBrothers($id)
    {
        $parent_id = $this->db_connection->find($id)->parent_id;

        return $this->db_connection
            ->where('parent_id','=',$parent_id)
            ->get(['status','id']);
    }
}