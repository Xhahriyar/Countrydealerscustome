<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ExpenseChart;
use App\Charts\Purchase;
use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    public function index(ExpenseChart $expenseChart , Purchase $purchaseChart)
    {
        $salesCount = $this->dashboardRepository->totalSales();
        $totalSalesAmount = $this->dashboardRepository->totalSalesAmount();
        $expensesCount = $this->dashboardRepository->expenses();
        $TotalexpensesAmount = $this->dashboardRepository->TotalexpensesAmount();
        $purchasesCount = $this->dashboardRepository->purchases();
        $totaPurchasesAmount = $this->dashboardRepository->totaPurchasesAmount();
        return view("admin.dashboard" , ['expenseChart' => $expenseChart->build() , 'purchaseChart' => $purchaseChart->build()] , compact('salesCount' , 'expensesCount', 'purchasesCount' , 'totaPurchasesAmount' , 'TotalexpensesAmount' , 'totalSalesAmount'));
    }
    public function dashboard()
    {
        return view("admin.dashboard");
    }

     /**
     * Display a listing of the resource.
     */
    public function getUser(Request $request)
    {
        $this->authorize(PermissionEnum::ADMIN_LIST(), [User::class]);

        $filters = $request->all();
        $admins = $this->service->getAll($filters);
        $adminCount = $admins->total();

        return Inertia::render('Admins/index', ['admins' => $admins, 'searchParams' => $filters , 'adminCount' => $adminCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize(PermissionEnum::ADMIN_CREATE(), [User::class]);

        $filters = $request->all();
        $roles = $this->rolesService->getAll($filters);
        return Inertia::render('Admins/Partials/Create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $this->authorize(PermissionEnum::ADMIN_STORE(), [User::class]);

        $admin = $this->service->store($request->validated());
        if ($admin) {
            if ($request->filled('role')) {
                $this->service->updateRole($admin, $request->input('role'));
            }
            $this->service->sendEmail($admin);

            return Redirect::route('admins.index')->with('success', Config('flashMessagesConstants.admin.success.created'));
        }
        return Redirect::route('admins.index')->with('error', Config('flashMessagesConstants.admin.error.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize(PermissionEnum::ADMIN_EDIT(), [User::class]);

        $id = decodeId($id);
        $admin = $this->service->getOne($id);
        $roles = $this->rolesService->getAll([],false);
        return Inertia::render('Admins/Partials/Edit', ['admin' => $admin, 'roles' => $roles, 'assignedRoles' => $admin->roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $this->authorize(PermissionEnum::ADMIN_UPDATE(), [User::class]);

        $admin = $this->service->getOne($id);
        $this->service->update($request->validated(), $admin);
        if ($request->has('role')) {
            $this->service->updateRole($admin, $request->input('role'));
        }
        return Redirect::route('admins.index')->with('success', Config('flashMessagesConstants.admin.success.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize(PermissionEnum::ADMIN_DELETE(), [User::class]);

        $admin = $this->service->getOne($id);
        $this->service->destroy($admin);
        $admin->syncRoles([]); // removing all roles assigned
        return Redirect::route('admins.index')->with('success', Config('flashMessagesConstants.admin.success.deleted'));
    }


}
