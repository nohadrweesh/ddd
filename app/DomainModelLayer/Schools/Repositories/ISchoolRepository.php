<?php
/**
 * Created by PhpStorm.
 * User: RVM-13
 * Date: 1/23/2017
 * Time: 3:51 PM
 */

namespace App\DomainModelLayer\Classrooms;


interface IClassroomRepository
{
    public function getAllClassrooms();
    public function findClassroomById($id);
}