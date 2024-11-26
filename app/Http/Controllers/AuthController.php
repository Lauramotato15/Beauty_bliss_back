<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthLoginResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
     /**
     * Constructor e inyection del servicio de usuario
     * @return void
     * @author Laura Motato Moreno
     * @param \App\Service\UserService $service
     */
    public function __construct(private UserService $serviceUser)
    {

    }

    /**
     * Metodo para iniciar sesion
     * @author Laura Motato Moreno
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
    */

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        $validate = $this->serviceUser->login($credentials);
        return new AuthLoginResource($validate);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json( ["message " => "Sesión cerrada"], 300);
            
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo cerrar la sesion, intente de nuevo'], 500);
        }
    }
}
