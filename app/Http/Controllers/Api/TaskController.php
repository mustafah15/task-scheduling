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
use Yajra\Datatables\Datatables;

class TaskController extends BaseController
{

    protected  $manager ;

    public function __construct()
    {
        $this->manager = new TaskManager();
    }

    public function getCreateNew()
    {

    }

    public function getAllTasks()
    {
        $data =  $this->manager->selectAllTasksByColumns(['id','title','parent_id','status']);

        return Datatables::of($data)->make(true);
    }
}