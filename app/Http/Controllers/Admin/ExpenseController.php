<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Services\CountService;
use Illuminate\Http\Request;
use App\Repositories\ExpenseRepository;
class ExpenseController extends Controller
{
    protected $expenseRepository;
    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }
    public function index(Request $request)
    {
        if ($request->has('query')) {
            $searchData = $request->all();
            $data = $this->expenseRepository->search($searchData);
            $count = CountService::expenseCount($data);
            return view("admin.expense.index", compact('data', 'count'));
        }
        $data = $this->expenseRepository->all();
        $count = CountService::expenseCount($data);
        return view("admin.expense.index", compact('data', 'count'));
    }
    public function store(StoreExpenseRequest $request)
    {
        $this->expenseRepository->store($request->all());
        return redirect()->back()->with('success', 'Record Created Successfully.');
    }
    public function delete($id)
    {
        $this->expenseRepository->delete($id);
        return redirect()->back()->with('success', 'Record Deleted Successfully.');
    }
}
