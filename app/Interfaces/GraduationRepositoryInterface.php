<?php
namespace App\Interfaces;

  interface GraduationRepositoryInterface {

    public function index();
    public function create();
    public function soft_delete($request);
    public function rollback_of_graduation($request);
    public function destroy($request);







    
}