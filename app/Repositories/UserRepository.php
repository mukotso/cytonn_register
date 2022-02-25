<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Mail\UserRegistration;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }


    public function createUser(array $userDetails)
    {
        return DB::transaction(function () use ($userDetails) {

            try {
                $randomPassword = Str::random(9);
                $hashedPassword = bcrypt($randomPassword);
                $userDetails['password'] = $hashedPassword;
                $userDetails['phone_number'] = '+254' . $userDetails['phone_number'];
                $userDetails['email'] = strtolower(trim($userDetails['email']));

                $user = User::create($userDetails);
                $details = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $randomPassword,
                ];

                Mail::to($user->email)->send(new UserRegistration($details));

                return $user;
            } catch (Exception $ex) {
                DB::rollBack();
                return response()->json('error', '400');
            }
        }, 2);
    }

    public function updateUser($user, $newDetails)
    {
        return $user->update($newDetails);
    }

    public function deleteUser($userId)
    {
        return User::destroy($userId);
    }
}
