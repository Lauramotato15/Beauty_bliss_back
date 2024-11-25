<?php
namespace App\Services;

use App\AO\IBaseAo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseService  implements IBaseAo 
{
    public function __construct(private IBaseAo $repository)
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
        return $this->repository->find($id);
    }

    public function update($id, array $data)
    {
        $record = $this->repository->find($id);
        if(!$record){
            throw new NotFoundHttpException('Recurso no encontrado');
        }
        $record?->update($data);
        return $record;
    }

    public function delete($id){
        return $this->repository->delete($id);
    }
} 
?> 