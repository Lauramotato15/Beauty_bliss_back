<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IBaseRepository
{
  public function create(array $data);   
  public function all(): Collection; 
  public function find($id);
  public function update($id, array $data);
  public function delete($id); 
}
?>