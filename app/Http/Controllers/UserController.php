<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\LanguageResource;
use App\Models\User;
use App\Models\Language;
use Illuminate\Support\Facades\Validator;
use App\Repository\UserRepositoryInterface;


class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

}
