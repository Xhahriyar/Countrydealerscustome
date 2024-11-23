<?php

namespace App\Services\User;

use App\DTO\Roles\RoleDTO;
use App\DTO\User\UserDTO;
use App\Repositories\User\UserRepository;
use App\Trait\SetLoggedUserDataTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserService
{
    use SetLoggedUserDataTrait;
    /**
     * @param  AdminRepository  $repository
     */
    public function __construct(
        protected  UserRepository $repository,
    ) {}

    public function getAll(array $filters = [], $pagination = true, $select = '*')
    {
        return $this->repository->getAll($filters, $pagination , $select);
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
        return $this->repository->getOne($value, $column, $filters, $with, $select);
    }

    /**
     * @param $data
     */
    public function store($data)
    {
        $data['verify_token'] = Str::random(14);
        $data['password'] = Hash::make(12345678);
        $dto = new UserDTO(...$data);
        $data = $this->setLoggedUserData($dto);
        return $this->repository->store($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $modelValues
     * @param  int $id
     * @return bool
     */
    public function update($data, $admin)
    {
        $data['password'] = $admin['password'];
        $dto = new UserDTO(...$data);
        // dd($data);
        return $this->repository->update($dto->toArray(), $admin);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($admin)
    {
        return $this->repository->destroy($admin);
    }

    /**
     * @param $role
     * @return int
     */
    public function getRoleAdminsCount($role): int
    {
        return $this->repository->getRoleAdminsCount($role);
    }

    /**
     * @param $admin
     * @param $role
     * @return void
     */
    public function updateRole($admin, $role)
    {
        return $this->repository->updateRole($admin, new RoleDTO($role));
    }


}
