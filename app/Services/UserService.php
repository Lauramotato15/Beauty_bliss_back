<?php
namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService extends BaseService implements IBaseService{
   public function __construct(private UserRepository $userRepository)
   {
      parent::__construct($userRepository);
   }


   /**
     * Metodo para crear un usuario con una imagen
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return User
   */

   public function createUserWithFile(UserCreateRequest $request){
      $file = $request->file('photo');
      $data = $request->all();

      if($file){
         $fileName = time().'_'.$file->getClientOriginalName();
         $file->move(public_path('uploads'), $fileName);
         $data['photo'] = $fileName;
      }
      $createdUser =$this->userRepository->create($data);
      return $createdUser;
   }


  /**
   * Metodo para iniciar sesión'
   * @param array $credentials[user, password]
   * @return mixed
   */

  public function login($credentials){
      if (!$token = JWTAuth::attempt($credentials)) {
         return[];
      }

    $user = Auth::user();

      return [
         'token' => $token,
         'user' => new UserResource($user),
      ];
   }
}
?>