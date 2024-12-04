<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthLoginResource;
use App\Services\UserService;

class AuthController extends Controller
{
    
    public function __construct(private UserService $serviceUser)
    {

    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        $validate = $this->serviceUser->login($credentials);
        return new AuthLoginResource($validate);
    }

    public function logout()
    {
        $resp = $this->serviceUser->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Tu sesión ha sido cerrada con éxito.',
            'data' => $resp,
        ], 200);
    }
}
