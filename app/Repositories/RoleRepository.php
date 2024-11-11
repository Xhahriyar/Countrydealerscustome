<?php

namespace App\Repositories;

use App\DTO\Roles\RoleDTO;
use App\Models\Roles;

class RolesRepository extends BaseRepository
{
    /**
     * @param Roles $role
     */
    public function __construct(Roles $role)
    {
        $this->model = $role;
    }

    public function getAll($filters = [], $pagination = true)
    {
        $query = $this->model::query();

        $query = $query->where('guard_name', auth()->guard()->name);

        if (isset($filters['search']) && $filters['search']) {
            $query = $query->where('name', 'ilike', '%' . $filters['search'] . '%');
        }

        return $query->orderBy('id', 'desc')->paginate(Config('constants.PAGINATION_LIMIT'));
    }

    /**
     * @param  RoleData  $data
     * @return mixed
     */
    public function store($data = []): mixed
    {
        return $this->create($data);
    }

    /**
     * @param $role
     * @return bool
     */
    public function destroy($role): bool
    {
        return $this->model->query()->where('id', $role->id)->delete();
    }

    /**
     * @param $role
     * @param $permissions
     * @return void
     */
    public function updatePermissions($role, $permissions): void
    {
        $role = $this->model->query()
            ->where('name', $role->name)
            ->where('guard_name', auth()->guard()->name)
            ->first();
            // dd($permissions);
        $role->syncPermissions($permissions);
    }
}
