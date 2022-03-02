<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Mail\UserRegistration;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        $user=Auth::user();
        if($user->is_admin==1){
           return  User::with('department')->get();
        }else {
         abort(401);
        }

    }
    public function createUser(array $userDetails)
    {

        $user=Auth::user();
        if($user->is_admin==1){
        return DB::transaction(function () use ($userDetails) {

            try {
                $randomPassword = Str::random(9);
                $hashedPassword = bcrypt($randomPassword);
                $userDetails['password'] = $hashedPassword;
                $userDetails['phone_number'] = '+254' . $userDetails['phone_number'];
                $userDetails['email'] = strtolower(trim($userDetails['email']));
                $userDetails['is_admin'] = false;
                $user = User::create($userDetails);
                $details = [
                    'name' => $user->first_name,
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

        }else {
            abort(401);
        }
    }

    public function updateUser($user, $newDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            return $user->update($newDetails);
        }else {
            abort(401);
        }

    }

    public function deleteUser($userId)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            return User::destroy($userId);
        }else {
            abort(401);
        }
    }
}
