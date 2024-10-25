<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ExpenseChart;
use App\Charts\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;
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
}
