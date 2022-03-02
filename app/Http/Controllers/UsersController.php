<?php

namespace App\Http\Controllers;

use App\Http\Requests\addUserRequest;
use App\Http\Requests\editUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {

        $users = $this->userRepository->getAllUsers();
        if (request()->expectsJson()) {
            return response()->json($users, 200);
        } else {
            return view('users.index', compact('users'));
        }


    }

    public function store(addUserRequest $request)
    {
        return $this->userRepository->createUser($request->all());

    }

    public function update(editUserRequest $request, User $user)
    {
        return $this->userRepository->updateUser($user, $request->all());
    }

    public function destroy(User $user)
    {
        return $this->userRepository->deleteUser($user->id);
    }


}
