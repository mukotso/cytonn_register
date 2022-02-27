<?php

namespace App\Interfaces;


interface UserRepositoryInterface
{
    public function getAllUsers();
    public function deleteUser($userId);
    public function createUser(array $userDetails);
    public function updateUser($user, $newDetails);
}
