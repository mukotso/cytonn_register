<?php

namespace App\Http\Controllers;

use App\Http\Requests\passwordRequest;
use App\Interfaces\UserProfileRepositoryInterface;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public $userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    public function  index(){
        $userDetails= $this->userProfileRepository->getUserProfile();
        return view('profile.index' ,compact('userDetails'));
    }
    public function updatePassword(passwordRequest  $request){
        return $this->userProfileRepository->updatePassword($request);
    }
}
