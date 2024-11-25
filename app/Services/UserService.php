<?php
namespace App\Services;

use App\AO\UserAo;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService extends BaseService implements IBaseService{
   public function __construct(private UserAo $userRepository)
   {
      parent::__construct($userRepository);
   }

   /**
     * Metodo para crear un usuario con una imagen
     * @author laura Motato 
     * @param \App\Http\Requests\CreateUserRequest $request
     * @return mixed
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
         return response()->json([
            'message' => 'Unauthorized'
         ], 401);
      }

    $user = Auth::user();

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
   }
}
?>