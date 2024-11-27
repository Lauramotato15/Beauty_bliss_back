<?php
namespace App\Repositories;
use App\Models\User;

class UserRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(private User $userModel)
    {
        parent::__construct($userModel);
    }
    
    public function findByEmail($email){
        return $this->userModel->where('email', $email)->first();
    }
}
?> 