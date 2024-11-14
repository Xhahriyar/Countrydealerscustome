<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    /**
     * @param  PermissionRepositoryInterface  $repository
     */
    public function __construct(protected PermissionRepository $repository)
    {
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
