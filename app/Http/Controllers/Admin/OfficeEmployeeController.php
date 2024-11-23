<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddOfficeEmployeeRequest;
use App\Models\AdminOfficeEMployee;
use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Redirect;

class OfficeEmployeeController extends Controller
{
    protected $employeeRepository;
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    public function index()
    {
        $this->authorize(PermissionEnum::EMPLOYEE(), [AdminOfficeEMployee::class]);

        $data = $this->employeeRepository->all();
        return view("admin.officeEmployee.index", compact("data"));
    }
    public function create()
    {
        $this->authorize(PermissionEnum::EMPLOYEE_CREATE(), [AdminOfficeEMployee::class]);

        return view("admin.officeEmployee.create");
    }
    public function store(AddOfficeEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->create($request->all());
        if ($employee) {
            return Redirect::route('employee.office.index')->with("success", "Record Added Successfully");
        }
        return Redirect::route('employee.office.index')->with("error", "Error in Adding Record ");
    }

    public function show($id)
    {
        $this->authorize(PermissionEnum::EMPLOYEE_VIEW(), [AdminOfficeEMployee::class]);

        $data = $this->employeeRepository->find($id);
        return view("admin.officeEmployee.show", data: compact(var_name: 'data'));
    }
    public function edit($id)
    {
        $this->authorize(PermissionEnum::EMPLOYEE_EDIT(), [AdminOfficeEMployee::class]);

        $data = $this->employeeRepository->find($id);
        return view("admin.officeEmployee.edit", data: compact(var_name: 'data'));
    }
    public function update(AddOfficeEmployeeRequest $request, $id)
    {
        $employee = $this->employeeRepository->update($id, $request->all());
        if ($employee) {
            return Redirect::route('employee.office.index')->with("success", "Record Updated Successfully");
        }
        return Redirect::route('employee.office.index')->with("error", "Error in Updating Record ");
    }

    public function delete($id)
    {
        $this->authorize(PermissionEnum::EMPLOYEE_DELETE(), [AdminOfficeEMployee::class]);

        $employee = AdminOfficeEMployee::find($id);
        $employee->delete();
        return redirect()->back()->with('success', 'Record Deleted Successfully.');
    }
}
