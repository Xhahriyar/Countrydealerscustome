<?php

namespace App\Http\Controllers\User;

use App\Charts\ExpenseChart;
use App\Charts\PurchaseChart;
use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Users\StoreUserRequest;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    protected $dashboardRepository;

    public function __construct(
        DashboardRepository $dashboardRepository,
        protected UserService $service,
        protected RoleService $roleService,
    ) {
        $this->dashboardRepository = $dashboardRepository;
    }
    
    public function index(ExpenseChart $expenseChart, PurchaseChart $purchaseChart)
    {
        $this->authorize(PermissionEnum::DASHBOARD(), [User::class]);
    
        // Fetch sales data
        $salesData = $this->dashboardRepository->salesData();
        $totalSalesAmount = $salesData['totalSalesAmount'];
        $salesDates = $salesData['salesDates'];
        $salesAmounts = $salesData['salesAmounts'];
        $salesCount = $salesData['salesCount'];
    
        // Fetch purchase data
        $purchaseData = $this->dashboardRepository->purchaseData();
        $totalPurchaseAmount = $purchaseData['totalPurchaseAmount'];
        $purchaseDates = $purchaseData['purchaseDates'];
        $purchaseAmounts = $purchaseData['purchaseAmounts'];
        $purchasesCount = $purchaseData['purchasesCount'];
        $totalPurchasesAmount = $purchaseData['totalPurchasesAmount'];
    
        // Fetch expenses data
        $expenseData = $this->dashboardRepository->expensesData();
        $totalExpensesAmount = $expenseData['totalExpensesAmount'];
        $expenseDates = $expenseData['expenseDates'];
        $expenseAmounts = $expenseData['expenseAmounts'];
        $expensesCount = $expenseData['expensesCount'];
    
        // Standardize and sort dates in 'Y-m-d' format
        $salesDatesFormatted = array_map(fn($date) => Carbon::parse($date)->format('Y-m-d'), $salesDates);
        $purchaseDatesFormatted = array_map(fn($date) => Carbon::parse($date)->format('Y-m-d'), $purchaseDates);
        $expenseDatesFormatted = array_map(fn($date) => Carbon::parse($date)->format('Y-m-d'), $expenseDates);
    
        // Generate common dates and sort them
        $commonDates = array_unique(array_merge($salesDatesFormatted, $purchaseDatesFormatted, $expenseDatesFormatted));
        sort($commonDates); // Sort in ascending order
    
        // Fill missing data for the sorted dates
        $salesDataFilled = $this->fillMissingData($commonDates, $salesDatesFormatted, $salesAmounts);
        $purchaseDataFilled = $this->fillMissingData($commonDates, $purchaseDatesFormatted, $purchaseAmounts);
        $expenseDataFilled = $this->fillMissingData($commonDates, $expenseDatesFormatted, $expenseAmounts);
    
        // Convert commonDates back to 'd M Y' format
        $commonDatesFormatted = array_map(fn($date) => Carbon::parse($date)->format('d M Y'), $commonDates);
    
        return view("admin.dashboard", [
            'expenseChart' => $expenseChart->build(),
            'purchaseChart' => $purchaseChart->build(),
        ], compact(
            'salesCount',
            'expensesCount',
            'purchasesCount',
            'totalPurchasesAmount',
            'totalExpensesAmount',
            'totalSalesAmount',
            'salesDataFilled', // Filled sales data
            'purchaseDataFilled', // Filled purchase data
            'expenseDataFilled', // Filled expense data
            'commonDatesFormatted', // Display-ready formatted dates
        ));
    }
    
    /**
     * Function to fill missing data with 0 for given dates and amounts
     * 
     * @param array $commonDates The unified list of all dates
     * @param array $categoryDates The dates specific to the category (sales, purchase, expense)
     * @param array $categoryAmounts The amounts corresponding to the category
     * 
     * @return array The data with missing points filled with 0
     */
    private function fillMissingData($commonDates, $categoryDates, $categoryAmounts)
    {
        $filledData = [];
        foreach ($commonDates as $date) {
            $key = array_search($date, $categoryDates);
            $filledData[] = ($key !== false) ? $categoryAmounts[$key] : 0; // Use 0 if no data for the date
        }
        return $filledData;
    }



    public function dashboard()
    {
        $this->authorize(PermissionEnum::DASHBOARD_VIEW(), [User::class]);

        return view("admin.dashboard");
    }

    /**
     * Display a listing of the resource.
     */
    public function getUser(Request $request)
    {
        $this->authorize(PermissionEnum::USER(), [User::class]);

        $filters = $request->all();
        $users = $this->service->getAll($filters);
        $userCount = $users->total();

        return view('users.index', ['users' => $users, 'searchParams' => $filters, 'userCount' => $userCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize(PermissionEnum::USER_CREATE(), [User::class]);

        $filters = $request->all();
        $roles = $this->roleService->getAll($filters);
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->service->store($request->validated());
        if ($user) {
            if ($request->filled('role')) {
                $this->service->updateRole($user, $request->input('role'));
            }

            return Redirect::route('users.index')->with("success", "Record Added Successfully");;
        }
        return Redirect::route('users.index')->with("error", "Error in Adding Record");;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit($id)
    // {
    //     $this->authorize(PermissionEnum::USER_EDIT(), [User::class]);

    //     $id = decodeId($id);
    //     $admin = $this->service->getOne($id);
    //     $roles = $this->roleService->getAll([], false);
    //     return Inertia::render('Admins/Partials/Edit', ['admin' => $admin, 'roles' => $roles, 'assignedRoles' => $admin->roles]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateAdminRequest $request, $id)
    // {

    //     $admin = $this->service->getOne($id);
    //     $this->service->update($request->validated(), $admin);
    //     if ($request->has('role')) {
    //         $this->service->updateRole($admin, $request->input('role'));
    //     }
    //     return Redirect::route('admins.index')->with('success', Config('flashMessagesConstants.admin.success.updated'));
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize(PermissionEnum::USER_DELETE(), [User::class]);

        $admin = $this->service->getOne($id);
        $this->service->destroy($admin);
        $admin->syncRoles([]); // removing all roles assigned
        return Redirect::route('users.index')->with("success", "Record Deleted Successfully");;
    }


    /**
     * Display the user's profile form.
     */
    public function editProfile(Request $request)
    {
        $user = $request->user();

        return view('profile.edit', ['data' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $this->service->update($request->validated(), $request->user());

        return redirect()->back()->with("success", "Profile Updated Successfully");
    }
}
