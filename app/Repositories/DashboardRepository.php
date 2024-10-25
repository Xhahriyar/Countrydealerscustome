<?php

namespace App\Repositories;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Purchase;
class DashboardRepository
{
    public function totalSales()
    {
        return Client::all()->count();
    }
    public function totalSalesAmount()
    {
        return Client::sum('plot_sale_price');
    }
    public function expenses()
    {
        return Expense::all()->count();
    }
    public function TotalexpensesAmount()
    {
        return Expense::sum('amount');
    }
    public function purchases()
    {
        return Purchase::all()->count();
    }
    public function totaPurchasesAmount()
    {
        return Client::sum('plot_sale_price');
    }
}
