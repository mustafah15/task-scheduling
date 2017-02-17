<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 12:16 PM
 */

namespace App\Datastructure;


class Node
{
    protected $id ;
    protected $title ;
    protected $parent_id;
    protected $status;

    /**
     * Node constructor.
     * @param $id
     * @param $title
     * @param int $parent
     * @param int $status
     */
    public function __construct($id, $title, $parent = 0, $status = 0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->parent_id = $parent;
        $this->status = $status;
    }

    /**
     * @param $id
     * @return $this
     */
    public function SetId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function SetTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function SetParentId($parent)
    {
        $this->parent_id = $parent;
        return $this;
    }

    /**
     * @param $status
     * @return $this
     */
    public function SetStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function GetId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function GetTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function GetParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return int
     */
    public function GetStatus()
    {
        return $this->status;
    }
}