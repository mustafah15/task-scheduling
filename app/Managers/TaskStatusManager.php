<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/23/17
 * Time: 9:07 PM
 */

namespace App\Managers;

use App\Enums\Status;
use App\Repositories\TaskRepository;

class TaskStatusManager
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TaskRepository();
    }

    public function changeToDone($id)
    {
        $ancestors = (new TaskManager())->getTaskAncestors($id);
        $dependencies = (new TaskManager())->getAllDependencies($id);

        if($this->isAncestorsDone($ancestors))
        {
            $this->changeAncestorsToComplete($ancestors);
            return $this->changeToComplete($id);
        }
        elseif($this->isAncestorsDone($dependencies))
        {
            $this->changeAncestorsToComplete($dependencies);
            return $this->changeToComplete($id);
        }
        else
            return $this->changeToDone($id);
    }

    public function isAncestorsDone($ancestors)
    {
        if (count($ancestors) == 0)
            return false;

        foreach ($ancestors as $ancestor)
        {

            if ($ancestor[0]->status == Status::InProcess)
                return false;
        }
        return true;
    }

    public function changeAncestorsToDone($ancestors)
    {
        foreach ($ancestors as $ancestor)
        {
            $this->repository
                ->editItem(['status'=>Status::Done],$ancestor->id);
        }
    }

    public function changeAncestorsToComplete($ancestors)
    {
        foreach ($ancestors as $ancestor)
        {
            $this->changeToComplete($ancestor[0]->id);
        }
    }

    public function isAncestorsCompleted($ancestors)
    {
        if (count($ancestors) == 0)
            return false;

        foreach ($ancestors as $ancestor)
        {
            if ($ancestor[0]->status != Status::Complete)
                return false;
        }
        return true;
    }

    public function changeToInProgress($id)
    {
        $ancestors = (new TaskManager())->getTaskAncestors($id);
        if ($this->isAncestorsCompleted($ancestors))
            $this->changeAncestorsToDone($ancestors);

        return $this->repository->editItem(['status'=>Status::InProcess],$id);
    }

    public function changeToComplete($id)
    {
        return $this->repository->editItem(['status'=>Status::Complete],$id);
    }
}