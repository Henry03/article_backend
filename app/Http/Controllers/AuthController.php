<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $AuthRepository;

    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

    public function login(AuthRequest $request)
    {

        try {
            $user = $this->AuthRepository->login($request);
            return $user;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
