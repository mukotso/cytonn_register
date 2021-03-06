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
        return User::with('department')->get();
    }

    public function createUser(array $userDetails)
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
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

                    return response()->json(['message' => "User Created successfully"], 200);
                } catch (Exception $ex) {
                    DB::rollBack();
                    return response()->json([
                        'errors' => json_decode('{ "error": "An error occurred Please Try again" }'),
                    ], 400);
                }
            }, 2);

        } else {
            abort(401);
        }
    }

    public function updateUser($user, $newDetails)
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
            $user->update($newDetails);
            return response()->json(['message' => "Details Updated successfully"], 200);
        } else {
            abort(401);
        }

    }

    public function deleteUser($userId)
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
            User::destroy($userId);
            return response()->json(['message' => "User Removed successfully"], 200);
        } else {
            abort(401);
        }
    }
}
