<?php

namespace App\Repositories;
use App\Models\Expense;
class ExpenseRepository
{
    protected $model;

    public function __construct(Expense $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function store($data)
    {
        if (isset($data['picture']) && $data['picture']->isValid()) {
            $data['picture'] = $data['picture']->store('expenseImages', 'public');
        }
        $this->model->create($data);
    }
    public function search($searchData)
    {
        // Get the input values from the form
        $expenseCategory = $searchData['expense_category'] ?? null;
        $expenseType = $searchData['expense_type'] ?? null;
        $expenseName = $searchData['name'] ?? null;
        $fromDate = $searchData['from'] ?? null;
        $toDate = $searchData['to'] ?? null;

        // Check if all inputs are empty
        if (empty($expenseCategory) && empty($expenseType) && empty($expenseName) && empty($fromDate) && empty($toDate)) {
            // Return an empty collection or handle as needed when no filters are provided
            return collect();
        }

        $expenses = $this->model::query();

        // Apply filters if provided
        if (!empty($expenseCategory)) {
            $expenses->where('expense_category', $expenseCategory);
        }
        if (!empty($expenseType)) {
            $expenses->where('expense_type', $expenseType);
        }
        if (!empty($expenseName)) {
            $expenses->where('name', 'like', '%' . $expenseName . '%');
        }
        if (!empty($fromDate)) {
            $expenses->whereDate('date', '>=', $fromDate);
        }
        if (!empty($toDate)) {
            $expenses->whereDate('date', '<=', $toDate);
        }

        // Execute the query and get the results
        return $expenses->get();
    }


    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
