<?php
namespace App\Services;

use App\Repositories\IBaseRepository;
use Error;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseService  implements IBaseRepository 
{
    /**
    * Constructor para inyectar el repositorio en la clase.
    *
    * Este constructor recibe una instancia de un repositorio que implementa la interfaz
    * `IBaseRepository` y la inyecta en la propiedad `$repository`, permitiendo a la clase
    * interactuar con la lógica de acceso a datos.
    *
    * @param \App\Repositories\IBaseRepository
    */
    public function __construct(private IBaseRepository $repository)
    {

    }
    
    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
   * Metodo para crear un usuario con una imagen
   * Se valida que la imagen haya llegado y se le asigna un nombre único
   * y se define la carpeta en donde se almacenara localmente
   * 
   * @param \App\Http\Requests\UserCreateRequest $request, la imagen es opcional
   * 
   * @return User
   */
    public function createWithFile($request)
    {
      $file = $request->file('photo');
      $data = $request->all();
      if ($file) {
        $fileName = time(). '_' .$file->getClientOriginalName();
        $file->move(storage_path('app/public/uploads'), $fileName);
  
        $data['photo'] = $fileName;
      }
      $create = $this->repository->create($data);
      return $create;
    }

    public function updateWithFile($id, $request)
    {
       $record = $this->repository->find($id);
       if(!$record){
            throw new NotFoundHttpException('Recurso no encontrado');
        }
        
      $file = $request->file('photo');
      $data = $request->all();
      if ($file) {
        $fileName = time(). '_' .$file->getClientOriginalName();
        $file->move(storage_path('app/public/uploads'), $fileName);
  
        $data['photo'] = $fileName;
      }
      $resp = $this->repository->update($id, $data);
      
      return $resp; 
    }


    public function find($id){
        $userFind = $this->repository->find($id); 
        if(!$userFind) {
            throw new NotFoundHttpException('Recurso no encontrado');
        }
        return $this->repository->find($id);
    }

    public function update($id, array $data)
    {
        $record = $this->repository->find($id);
        if(!$record){
            throw new NotFoundHttpException('Recurso no encontrado');
        }
        $resp = $this->repository->update($id, $data); 
        return $resp;
    }

    public function delete($id){
        $resp = $this->repository->delete($id);
        if(!$resp){
            throw new NotFoundHttpException('Recurso no encontrado');
        }
        return $resp;
    }
} 
?> 