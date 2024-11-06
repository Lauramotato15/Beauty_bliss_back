<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $serviceUser)
    {
        
    }

    public function store(UserCreateRequest $request){
        $userFind = $request->all(); 
        $newUser = $this->serviceUser->create($userFind);
        return new UserResource($newUser);
    }    

    public function index(){
        $users = $this->serviceUser->all();
        return UserResource::collection($users);
    }


    public function update($id, UserCreateRequest $request){
        dump($id);
        $userUpdate = $this->serviceUser->update($id, $request->all());
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
 