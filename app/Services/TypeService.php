<?php

namespace App\Services;
use App\Models\Expense;
use App\Models\Type;
class TypeService
{

    public static function getClientTypes()
    {
        return Type::where('type_category', 'client')->get();
    }
    public static function getPurchaseTypes()
    {
        return Type::where('type_category', 'purchase')->get();
    }
    public static function getExpenseTypes()
    {
        return Type::where('type_category', 'expense')->get();
    }
    public static function getExpenseCategories()
    {
        return Type::where('type_category', 'expense category')->get();
    }
    public static function getEmployeeDesignation()
    {
        return Type::where('type_category', 'employee designation')->get();
    }
    public static function getEmployeeDepartment()
    {
        return Type::where('type_category', 'employee department')->get();
    }
    public static function getExpenseNames()
    {
        return Expense::pluck('name');
    }

}
