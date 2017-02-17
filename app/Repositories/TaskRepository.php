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

}