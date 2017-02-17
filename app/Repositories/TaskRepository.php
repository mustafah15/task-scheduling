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

    public function checkDependencies($task_id, $dependencies = [], $num_of_dependencies = 0)
    {
        if ($task_id == 0 )
            return ['num_dependencies'=>$num_of_dependencies,'dependencies'=>$dependencies];
        else
        {
            $tasks = $this->db_connection->where('parent_id','=',$task_id)->get();
            $dependencies[] = (array) $tasks;
            $num_of_dependencies += $this->db_connection->where('parent_id','=',$task_id)->count();

            foreach ($tasks as $task)
                return $this->checkDependencies($task->id, $dependencies, $num_of_dependencies);
        }
    }

}