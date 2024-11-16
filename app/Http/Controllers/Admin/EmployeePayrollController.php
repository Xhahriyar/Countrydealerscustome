<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Services\CountService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use App\Repositories\PayrollRepository;

class EmployeePayrollController extends Controller
{
    protected $payrollRepository;
    public function __construct(PayrollRepository $payrollRepository)
    {
        $this->payrollRepository = $payrollRepository;
    }
    public function index(Request $request)
    {
        $this->authorize(PermissionEnum::PAYROLL(), [Payroll::class]);
        
        if ($request->has('query')) {
            $data = $this->payrollRepository->search($request->all());
            $count = CountService::PayrollCount($data);
            return view("admin.payrolls.index", compact("data" , "count"));
        }
        $data = $this->payrollRepository->all();
        $count = CountService::PayrollCount($data);
        return view("admin.payrolls.index", compact("data" , "count"));
    }

    public function payrollPdf()
    {
        $data = $this->payrollRepository->all();
        return view("admin.payrolls.pdf", compact("data"));
    }
}
