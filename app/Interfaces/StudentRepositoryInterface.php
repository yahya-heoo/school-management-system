<?php

namespace App\Interfaces;
 
interface StudentRepositoryInterface {

    public function getSections($id);
    public function getClasses($id);
    public function getStudents();
    public function createStudents();
    public function storeStudents($request);
    public function updateStudents($request);
    public function editStudents($id);
    public function deleteStudents($id);
    public function showStudent($id);
    public function upload_attachments($request);
    public function download_attachments($attachmentID);
    public function delete_attachments($request);

    
}