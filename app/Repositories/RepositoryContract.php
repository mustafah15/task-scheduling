<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 11:35 AM
 */

namespace App\Repositories;


interface RepositoryContract
{
    public function createNew($data);

    public function editItem($data,$id);

    public function getAll();

    public function getById($id);
}