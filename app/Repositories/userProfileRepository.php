<?php

namespace App\Repositories;

use App\Interfaces\UserProfileRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userProfileRepository implements UserProfileRepositoryInterface
{
    public function getUserProfile()
    {
        return User::where('id', Auth::user()->id)->with('department')->first();
    }

    public function updatePassword($request)
    {
        $hashed_password=auth()->user()->password;
        $oldPassword=$request->oldpassword;
        $newPassword=$request->password;
        if (Hash::check($oldPassword, $hashed_password)) {
            if (!Hash::check($newPassword, $hashed_password)) {
                $id = auth()->user()->id;
                $user = User::where('id',$id)->first();
                $user->password=Hash::make($newPassword);
                $user->save();

                return response()->json(['message' => "Password updated sucessfully"],200);
            } else {
                return response()->json([
                    'errors' => json_decode('{ "password": "Old Password can be same as new password please try setting a different password" }'),
                ], 400);

            }
        } else {

            return response()->json([
                'errors' => json_decode('{ "password": "incorrect Old Password" }'),
            ], 400);
        }
    }
}
