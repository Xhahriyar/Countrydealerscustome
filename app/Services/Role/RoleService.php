<?php

namespace App\Services\Role;

use App\DTO\Roles\RoleDTO;
use App\Repositories\Role\RoleRepository;

class RoleService
{
    /**
     * @param RoleRepository $repository
     */
    public function __construct(protected RoleRepository $repository)
    {
    }


    public function getAll(array $filters = [], $pagination = true)
    {
        return $this->repository->getAll($filters, $pagination);
    }

    /**
     * @param $value
     * @param string $column
     * @param array $filters
     * @param array $with
     * @param string $select
     * @return mixed
     */
    public function getOne($value, $column = 'id', $filters = [], $with = [], $select = '*')
    {
        // get specific
        return $this->repository->getOne($value, $column, $filters, $with, $select);
    }

    /**
     * @param $data
     */
    public function store($data)
    {
        // dd($data);
        $data['guard_name'] = auth()->guard()->name;
        $dto = new RoleDTO(...$data);
        return $this->repository->store($dto->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $modelValues
     * @param  int $id
     * @return bool
     */
    public function update($data, $role)
    {
        $data['guard_name'] = auth()->guard()->name;
        $dto = new RoleDTO(...$data);
        return $this->repository->update($dto->toArray(), $role);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($role)
    {
        return $this->repository->destroy($role);
    }

    /**
     * @param $role
     * @param $permissions
     * @return void
     */
    public function updatePermissions($role, $permissions): void
    {
        // $permissionHeaders = [];
        // foreach ($permissions as $permission) {
        //     $header = explode('-', $permission)[0];
        //     $header_check[] = $header;
        //     if (! in_array($header, $permissionHeaders)) {
        //         $permissionHeaders[] = $header;
        //     }
        // }
        // // dd($header_check);
        // $permissions = array_merge($permissions, $permissionHeaders);

        $this->repository->updatePermissions(new RoleDTO($role->name), $permissions);
    }
}
