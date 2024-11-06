<?php
namespace App\AO;

use App\AO\BaseAo;
use App\AO\IBaseAo;
use App\Models\User;

class UserAo extends BaseAo implements IBaseAo
{
    public function __construct(private User $userModel)
    {
        parent::__construct($userModel);
    }
    
}
?> 