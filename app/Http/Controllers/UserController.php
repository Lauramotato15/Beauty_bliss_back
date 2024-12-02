<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Services\UserService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $user = $this->serviceUser->createWithFile($request);
        return new UserResource($user);
    } 

    public function update(UserUpdateRequest $request){
        try {
            $authenticated_user = $request->user();
            $userUpdate = $this->serviceUser->update($authenticated_user->id, $request->all());
            $userUpdate = $this->serviceUser-> updateWithFile($authenticated_user->id, $request);
            return new UserResource($userUpdate); 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404); 
        }
    }

    public function show($id){
        $userFind = $this->serviceUser->find($id);
        return new UserResource($userFind);
    }

    public function destroy($id){
        try {
            $resp = $this->serviceUser->delete($id);
            return $resp; 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } 
    }

}
 