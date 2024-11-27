<?php
namespace App\Repositories;

use App\Models\Client;
use App\Models\Expense;
use App\Models\Purchase;
use Illuminate\Support\Carbon;

class DashboardRepository
{
    // Get the total number of sales (clients)
    public function totalSales()
    {
        return Client::all()->count();
    }

    // Get the total sales amount
    public function totalSalesAmount()
    {
        return Client::sum('plot_sale_price');
    }

    // Get detailed sales data, grouped by date
    public function salesData()
    {
        $salesData = [];

        $salesData['salesCount'] = Client::all()->count();
        $salesData['totalSalesAmount'] = Client::sum('plot_sale_price');

        // Get the sales grouped by date and sum the plot_sale_price for each date
        $salesGroupedByDate = Client::select('date')
            ->selectRaw('SUM(plot_sale_price) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_sales', 'date');

        // Format the dates and sales amounts for chart
        $salesData['salesDates'] = $salesGroupedByDate->keys()->map(function ($date) {
            return Carbon::parse($date)->format('d M Y'); // Format date to "12 Nov 2024"
        })->toArray();

        $salesData['salesAmounts'] = $salesGroupedByDate->values()->map(function ($amount) {
            return number_format($amount, 2); // Format amount with commas
        })->toArray();

        return $salesData;
    }

    // Get the total number of expenses, total amount, and expenses grouped by date
    public function expensesData()
    {
        $expenseData = [];

        $expenseData['expensesCount'] = Expense::all()->count();
        $expenseData['totalExpensesAmount'] = Expense::sum('amount');

        // Get the expenses grouped by date and sum the amounts for each date
        $expenseGroupedByDate = Expense::select('date')
            ->selectRaw('SUM(amount) as total_expenses')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_expenses', 'date');

        // Format the dates and expense amounts for chart
        $expenseData['expenseDates'] = $expenseGroupedByDate->keys()->map(function ($date) {
            return Carbon::parse($date)->format('d M Y'); // Format date to "12 Nov 2024"
        })->toArray();

        $expenseData['expenseAmounts'] = $expenseGroupedByDate->values()->map(function ($amount) {
            return number_format($amount, 2); // Format amount with commas
        })->toArray();

        return $expenseData;
    }

    // Get the total number of purchases
    public function purchases()
    {
        return Purchase::all()->count();
    }

    // Get detailed purchase data, grouped by date
    public function purchaseData()
    {
        $purchaseData = [];

        $purchaseData['purchasesCount'] = Purchase::all()->count();
        $purchaseData['totalPurchasesAmount'] = Purchase::sum('plot_sale_price');

        $purchaseData['totalPurchaseAmount'] = Purchase::sum('plot_sale_price');

        // Get the purchases grouped by date and sum the amounts for each date
        $purchaseGroupedByDate = Purchase::select('date')
            ->selectRaw('SUM(plot_sale_price) as total_purchase')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_purchase', 'date');

        // Format the dates and purchase amounts for chart
        $purchaseData['purchaseDates'] = $purchaseGroupedByDate->keys()->map(function ($date) {
            return Carbon::parse($date)->format('d M Y'); // Format date to "12 Nov 2024"
        })->toArray();

        $purchaseData['purchaseAmounts'] = $purchaseGroupedByDate->values()->map(function ($amount) {
            return number_format($amount, 2); // Format amount with commas
        })->toArray();

        return $purchaseData;
    }
}
