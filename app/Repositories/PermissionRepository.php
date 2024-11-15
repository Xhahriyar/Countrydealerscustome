<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    /**
     * PermissionRepository constructor.
     *
     * @param  Permission  $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function getAll($filters = [], $paginated = true)
    {
        return $this->model->query()
            ->where('guard_name', auth()->guard()->name)
            ->orderBy('sort_order', 'asc')
            ->orderBy('parent_id', 'asc')
            ->get();
    }
}
