<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfficerRerquest;
use App\Models\SalesOfficer;
use Illuminate\Http\Request;
use App\Repositories\SalesOfficerRepo;
use App\Models\Type;

class SalesOfficerController extends Controller
{
    protected $SalesOfficerRepo;
    public function __construct(SalesOfficerRepo $SalesOfficerRepo)
    {
        $this->SalesOfficerRepo = $SalesOfficerRepo;
    }
    public function index()
    {
        $this->authorize(PermissionEnum::SALES_OFFICER(), [SalesOfficer::class]);

        $data = $this->SalesOfficerRepo->all();
        // dd($data);
        return view("admin.salesOfficer.index" , compact("data"));
    }
    public function create()
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_CREATE(), [SalesOfficer::class]);

        $salesOfficerTypes = Type::where('type_category' , 'sales officer')->get();
        return view("admin.salesOfficer.create" , compact("salesOfficerTypes"));
    }
    public function store(OfficerRerquest $request)
    {
        $this->SalesOfficerRepo->store($request->all());
        return redirect()->back()->with("success","Record Created Successfully");
    }
    public function show($id)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_VIEW(), [SalesOfficer::class]);
        
        $data = $this->SalesOfficerRepo->getAllDealsDetails($id);
        return view('admin.salesOfficer.salesdetail.index' , compact('data' , 'id'));
    }
    public function installments($salesOfficerId , $clientId)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_VIEW(), [SalesOfficer::class]);

        $data = $this->SalesOfficerRepo->getAllInstallmentsDetails($salesOfficerId , $clientId);
        return view('admin.salesOfficer.salesdetail.installments' , compact('data' , 'salesOfficerId' , 'clientId'));
    }
    public function status($id)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_STATUS(), [SalesOfficer::class]);

        $data = $this->SalesOfficerRepo->updateCommissionStatus($id);
        return redirect()->back()->with("success","Record Updated Successfully");
    }
    public function updateCommission(Request $request , $salesOfficerId , $clientId)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_CREATE(), [SalesOfficer::class]);

        $request->validate([
            'commission_payment' => 'required',
            'paid_by' => 'required',
            'paid_date' => 'required',
        ]);
        $data = $this->SalesOfficerRepo->addCommissionDetails($request->all(),$salesOfficerId , $clientId);
        return redirect()->back()->with('success' , 'Commission Added Successfully.');
    }
    public function InstallmentStatus($installmenId , $salesOfficerId , $clientId)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_COMMISSION_INSTALLMENT_STATUS(), [SalesOfficer::class]);
        $data = $this->SalesOfficerRepo->updateInstallmentCommissionStatus($installmenId , $salesOfficerId , $clientId);
        return redirect()->back()->with("success","Record Updated Successfully");
    }
    public function delete($id)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_DELETE(), [SalesOfficer::class]);

        $this->SalesOfficerRepo->delete($id);
        return redirect()->back()->with("success","Record Deleted Successfully");
    }
    public function deleteCommission($id)
    {
        $this->authorize(PermissionEnum::SALES_OFFICER_COMMISSION_DELETE(), [SalesOfficer::class]);

        $this->SalesOfficerRepo->deleteCommission($id);
        return redirect()->back()->with("success","Record Deleted Successfully");
    }
}
