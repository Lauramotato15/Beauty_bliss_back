<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
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
        return $this->serviceUser->login($credentials);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['mensaje' => 'Cierre de sesión exitoso'], 200);
            
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'No se pudo cerrar la sesión, intente de nuevo'], 500);
        }
    }
}
