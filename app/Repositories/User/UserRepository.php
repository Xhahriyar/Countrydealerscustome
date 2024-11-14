<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class UserRepository extends BaseRepository
{
    /**
     * PermissionRepository constructor.
     *
     * @param  Permission  $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll($filters = [], $pagination = true , $select = '*')
    {
        $query = $this->model::query()->select($select);

        $query = $query->where('email', '!=', config('constants.SUPER_ADMIN_EMAIL'));
        if (isset($filters['search']) && $filters['search']) {
            $query = $query->where('name', 'ilike', '%' . $filters['search'] . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(Config('constants.PAGINATION_LIMIT'));
    }

    /**
     * @param  $data
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
    public function destroy($admin): bool
    {
        return $this->model->query()->where('id', $admin->id)->delete();
    }

    /**
     * @param $role
     * @return int
     */
    public function getRoleAdminsCount($role): int
    {
        return $this->model->query()->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role->name);
        })->count();
    }

    /**
     * @param $admin
     * @param $role
     * @return void
     */
    public function updateRole($admin, $role): void
    {
        $admin->syncRoles($role->name);
    }
}
