<?php
namespace App\Services;

use App\Repositories\IBaseRepository;
use Error;
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

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id){
        $userFind = $this->repository->find($id); 
        if(!$userFind) {
            throw new Error('Usuario no encontrado'); 
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