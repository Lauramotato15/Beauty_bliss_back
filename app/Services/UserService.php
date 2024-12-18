<?php
namespace App\Services;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService extends BaseService implements IBaseService
{
  public function __construct(private UserRepository $userRepository)
  {
      parent::__construct($userRepository);
  }

  /**
   * Método para validar las credenciales del usuario, generar un token JWT e iniciar sesión.
   *
   * Este método recibe las credenciales del usuario (nombre de usuario y contraseña),
   * valida las credenciales utilizando JWTAuth, y devuelve un token de autenticación
   * junto con los detalles del usuario si la autenticación es exitosa.
   *
   * @param \App\Http\Requests\LoginRequest $credentials Array que contiene las credenciales del usuario.
   *     El array debe tener las claves 'user' y 'password'.
   * 
   * @return \Illuminate\Http\JsonResponse Retorna una respuesta JSON con el token y los detalles del usuario.
   *     Si la autenticación falla, retorna un array vacío.
   */
  public function login($credentials)
  {
      if (!($token = JWTAuth::attempt($credentials))) {
        return [];
      }

      $user = Auth::user();

      return [
        'token' => $token,
        'user' => new UserResource($user),
      ];
  }

  /**
 * Método para cerrar la sesión del usuario revocando su token de autenticación JWT.
 * Este método invalida el token JWT actual del usuario para cerrar la sesión.
 *
 * @return \Illuminate\Http\JsonResponse Respuesta JSON con un mensaje de éxito o error.
 *     - Si es exitoso, retorna un mensaje 'Sesión cerrada' con código de estado HTTP 300.
 *     - Si ocurre un error, retorna un mensaje de error con código de estado HTTP 500.
 */
  public function logout()
  {
    try {
      JWTAuth::invalidate(JWTAuth::getToken());
      return true; 
      
    } catch (JWTException $e) {
        return response()->json(['error' => 'No se pudo cerrar la sesion, intente de nuevo'], 500);
    }
  }
}
?>
