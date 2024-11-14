<?php

namespace App\Repositories;

use App\Models\AdminOfficeEMployee;
use App\Models\Payroll;

class PayrollRepository
{
    protected $model;
    protected $employee;

    public function __construct(Payroll $model , AdminOfficeEMployee $employee)
    {
        $this->model = $model;
        $this->employee = $employee;
    }
    public function all()
    {
        return $this->employee::with('histories')->get();
    }
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function search($searchData)
    {
        $department = $searchData['department'] ?? null;
        $employeeType = $searchData['employee_type'] ?? null;
        $fromDate = $searchData['from'] ?? null;
        $toDate = $searchData['to'] ?? null;

        // Check if all inputs are empty
        if (empty($department) && empty($employeeType) && empty($fromDate) && empty($toDate)) {
            // Return an empty collection or handle as needed when no filters are provided
            return collect();
        }

        $expenses = $this->employee::query();

        // Apply filters if provided
        if (!empty($department)) {
            $expenses->where('department', $department);
        }
        if (!empty($employeeType)) {
            $expenses->where('employee_type', $employeeType);
        }
        if (!empty($fromDate)) {
            $expenses->whereDate('created_at', '>=', $fromDate);
        }
        if (!empty($toDate)) {
            $expenses->whereDate('created_at', '<=', $toDate);
        }
        // Execute the query and get the results
        return $expenses->with('histories')->get();
    }
}
