<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $serviceUser)
    {
        
    }
    
    public function index(){
        $users = $this->serviceUser->all();
        return new UserCollection($users);
    }

    public function store(UserCreateRequest $request){
        $user = $this->serviceUser->createUserWithFile($request);
        return new UserResource($user);
    } 

    public function update(UserUpdateRequest $request){
        $authenticated_user = $request->user();
        $userUpdate = $this->serviceUser->update($authenticated_user->id, $request->all());
        return new UserResource($userUpdate); 
    }

    public function destroy($id){
        $userDelete = $this->serviceUser->delete($id);
        if($userDelete){
            return response()->json('Accion realizada con exito',200);
        }

        return response()->json(null, 204);   
    }

    public function show($id){
        $userFind = $this->serviceUser->find($id);
        return new UserResource($userFind);
    }
}
 