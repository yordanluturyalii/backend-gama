<?php 

namespace App\Repository\Auth;

interface AuthRepository {
    public function addDataUser(array $data);
    public function getDataUserOrCreate($data);
}