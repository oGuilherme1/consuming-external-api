<?php

namespace App\Repositorys\Auth;

use App\Models\User;
use App\Repositorys\AbstractRepository;


class AuthRepository extends AbstractRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
