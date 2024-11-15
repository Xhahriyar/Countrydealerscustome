<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $guards = ['web'];
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $moduleLevelPermissions = config('permissionConstants');
        $permissions = [];
        foreach ($moduleLevelPermissions as $key => $moduleLevelPermission) {
            $permissions = array_merge($permissions, $moduleLevelPermission);
        }

        $permissionsCollection = new Collection();
        foreach ($guards as $guard) {
            $permissionsCollection = $permissionsCollection->merge(collect($permissions)->map(function ($permission) use ($guard) {
                return [
                    'name' => $permission['name'],
                    'label' => $permission['label'],
                    'is_visible' => $permission['is_visible'],
                    'guard_name' => $guard,
                    'sort_order' => $permission['sort_order'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }));
        }

        foreach ($permissionsCollection->toArray() as $permission) {
            $select = Permission::where(['name' => $permission['name'], 'guard_name' => $permission['guard_name']])->first();

            if ($select && !$select->is_visible) {
                $parentId = $select->id;
            }

            if ($select) {
                if (!$permission['is_visible']) {
                    $parentId = 0;
                }
                Permission::where(['name' => $permission['name'], 'guard_name' => $permission['guard_name']])->update(['label' => $permission['label'], 'is_visible' => $permission['is_visible'], 'parent_id' => $parentId, 'sort_order' => $permission['sort_order']]);
                $select = Permission::where(['name' => $permission['name'], 'guard_name' => $permission['guard_name']])->first();
                if ($select && !$select->is_visible) {
                    $parentId = $select->id;
                }
            } else {
                if (!$select && !$permission['is_visible']) {
                    $parentId = 0;
                }
                $permission['parent_id'] = $parentId ?? 0;
                Permission::insert($permission);
                if (!$select && !$permission['is_visible']) {
                    $select = Permission::where(['name' => $permission['name'], 'guard_name' => $permission['guard_name']])->first();
                    if ($select && !$select->is_visible) {
                        $parentId = $select->id;
                    }
                }
            }
        }
    }
}
