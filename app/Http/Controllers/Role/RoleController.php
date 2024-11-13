<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Enums\PermissionEnum;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Models\User;
use App\Services\PermissionService;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;

class RoleController extends Controller
{

    public function __construct(
        protected RoleService $service,
        protected PermissionService $permissionService,
        protected UserService $userService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize(PermissionEnum::ROLE_LIST(), [User::class]);

        $filters = $request->all();
        $roles = $this->service->getAll($filters);
        $roleCount = $roles->total();

        return view("roles.index", ['roles' => $roles, 'roleCount' => $roleCount,  'searchParams' => $filters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize(PermissionEnum::ROLE_CREATE(), [User::class]);

        $permissions = $this->permissionService->getAll();
        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize(PermissionEnum::ROLE_STORE(), [User::class]);
        
        $role = $this->service->store($request->validated());
        $permissions = $request['permissions'];
        $this->service->updatePermissions($role, $permissions);
        return Redirect::route('roles.index')->with('success', Config('flashMessagesConstants.roles.success.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize(PermissionEnum::ROLE_EDIT(), [User::class]);
        // dd($role);
        $permissions = $this->permissionService->getAll();
        $grantedPermissions = $role->permissions;
        // dd($permissions);
        // dd($grantedPermissions); 
        return Inertia::render('Roles/Partials/Edit', compact('role', 'permissions', 'grantedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize(PermissionEnum::ROLE_UPDATE(), [User::class]);

        $this->service->update($request->validated(), $role);
        $permissions = $request['permissions'];
        $this->service->updatePermissions($role, $permissions);
        return Redirect::route('roles.index')->with('success', Config('flashMessagesConstants.roles.success.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Role $role)
    {
        $this->authorize(PermissionEnum::ROLE_DELETE(), [User::class]);
        // Deleting role if not assigned to any user
        $contOfUsersHavingRole = $this->userService->getRoleAdminsCount($role);
        if ($contOfUsersHavingRole < 1) {
            $deleted = $this->service->destroy($role);
            return Redirect::route('roles.index')->with('success', Config('flashMessagesConstants.roles.success.deleted'));
        } else {
            return Redirect::route('roles.index')->with('error', Config('flashMessagesConstants.roles.error.deleted'));
        }
    }
}
