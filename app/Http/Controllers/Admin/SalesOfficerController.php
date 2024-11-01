<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficerRerquest;
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
        $data = $this->SalesOfficerRepo->all();
        // dd($data);
        return view("admin.salesOfficer.index" , compact("data"));
    }
    public function create()
    {
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
        $data = $this->SalesOfficerRepo->getAllDealsDetails($id);
        return view('admin.salesOfficer.salesdetail.index' , compact('data' , 'id'));
    }
    public function installments($salesOfficerId , $clientId)
    {
        $data = $this->SalesOfficerRepo->getAllInstallmentsDetails($salesOfficerId);
        return view('admin.salesOfficer.salesdetail.installments' , compact('data' , 'salesOfficerId' , 'clientId'));
    }
    public function status($id)
    {
        $data = $this->SalesOfficerRepo->updateCommissionStatus($id);
        return redirect()->back()->with("success","Record Updated Successfully");
    }
    public function InstallmentStatus($installmenId , $salesOfficerId , $clientId)
    {
        $data = $this->SalesOfficerRepo->updateInstallmentCommissionStatus($installmenId , $salesOfficerId , $clientId);
        return redirect()->back()->with("success","Record Updated Successfully");
    }
    public function delete($id)
    {
        $this->SalesOfficerRepo->delete($id);
        return redirect()->back()->with("success","Record Deleted Successfully");
    }
}
