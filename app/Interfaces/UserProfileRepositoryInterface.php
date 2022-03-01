<?php

namespace App\Interfaces;


interface UserProfileRepositoryInterface
{
    public function getUserProfile();
    public function updatePassword($request);
}
