<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 11:39 AM
 */

namespace App\Repositories;


class RepositoryBase
{
    protected  $db_connection;

    public function createNew($data)
    {
        return $this->db_connection->add($data);
    }

    public function editItem($data,$id)
    {
        return $this->db_connection->where('id','=',$id)->update($data);
    }

    public function getAll()
    {
        return $this->db_connection->all();
    }

    public function getById($id)
    {
        return $this->db_connection->find($id);
    }

    public function deleteItem($id)
    {
        return $this->db_connection->where('id','=',$id)->delete();
    }

    public function getAllWhere($db_item,$condition,$value)
    {
        return $this->db_connection->where($db_item,$condition,$value)->get();
    }



}