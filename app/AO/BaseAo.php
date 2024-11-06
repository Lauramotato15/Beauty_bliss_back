<?php
namespace App\AO;

use Illuminate\Database\Eloquent\Model;

abstract class BaseAo implements IBaseAo
{
    public function __construct(private Model $model)
    {

    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        $record?->update($data);
        return $record;
    }

    public function delete($id){
        return $this->model->where("id", $id)->delete();
    }
}
?> 