<?php
namespace App\Services; 

interface IBaseService
{
    public function create(array $data); 
    public function all(); 
    public function find($id);
    public function update($id, array $data);
    public function delete($id); 
} 
?>