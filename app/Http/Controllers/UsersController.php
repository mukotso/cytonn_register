<?php

namespace App\Http\Controllers;

use App\Http\Requests\addUserRequest;
use App\Http\Requests\editUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

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
            return redirect()->route('users.index', compact('users'));
        }
    }

    public function store(addUserRequest $request)
    {

        $user = $this->userRepository->createUser($request->all());
        if (request()->expectsJson()) {

            return response()->json($user, 201);
        } else {
            return redirect()->route('users.index');
        }
    }

    public function update(editUserRequest $request, User $user)
    {
        $user = $this->userRepository->updateUser($user, $request->all());
        if (request()->expectsJson()) {
            return response()->json($user, 201);
        } else {
            return redirect()->route('users.index');
        }

    }

    public function destroy(User $user)
    {
        $this->userRepository->deleteUser($user->id);
        if (request()->expectsJson()) {
            return response()->json(200);
        } else {
            return redirect()->route('users.index');
        }

    }


}
