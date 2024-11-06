<?php
namespace App\Services;

use App\AO\UserAo;

class UserService extends BaseService implements IBaseService{
   public function __construct(private UserAo $userRepository)
   {
      parent::__construct($userRepository);
   }
}
?>