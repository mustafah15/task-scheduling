<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/17
 * Time: 9:04 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{

    protected $table = 'tasks';

    protected $fillable = [
        'parent_id',
        'title',
        'status',
    ];
}