<?php

namespace App\Services\Auth;

use App\Repositorys\Auth\AuthRepository;
use App\Services\AbstractService;

class AuthService extends AbstractService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
}
