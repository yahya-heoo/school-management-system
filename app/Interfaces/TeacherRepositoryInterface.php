<?php

namespace App\Interfaces;



interface TeacherRepositoryInterface {

    public function getAllTeachers();

    public function getGenders();

    public function getSpecializations();

    public function storeTeachers($request);

    public function editTeachers($id);

    public function updateTeachers($request);
    
    public function deleteTeachers($id);

}