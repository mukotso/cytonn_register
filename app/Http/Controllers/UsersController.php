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
//        $this->authorize('update');
        $user = $this->userRepository->createUser($request->all());
        if (request()->expectsJson()) {
            return response()->json($user, 200);
        } else {
            return redirect()->route('users.index');
        }
    }

    public function update(editUserRequest $request, User $user)
    {
//        $this->authorize('update');
        $user = $this->userRepository->updateUser($user, $request->all());
        if (request()->expectsJson()) {
            return response()->json($user, 200);
        } else {
            return redirect()->route('users.index');
        }

    }

    public function destroy(User $user)
    {
//        $this->authorize('update');
        $this->userRepository->deleteUser($user->id);
        if (request()->expectsJson()) {
            return response()->json(200);
        } else {
            return redirect()->route('users.index');
        }

    }


}
