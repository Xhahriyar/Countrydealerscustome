<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientInstallment\InstallmentStatusUpdateRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Repositories\SalesOfficerRepo;
use App\Services\CountService;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use App\Repositories\PlotInstallmentRepo;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    protected $clientRepository;
    protected $plotInstallmentRepository;
    protected $salesOfficerRepo;

    public function __construct(
        ClientRepository $clientRepository,
        PlotInstallmentRepo $plotInstallmentRepository,
        SalesOfficerRepo $salesOfficerRepo
    ) {
        $this->clientRepository = $clientRepository;
        $this->plotInstallmentRepository = $plotInstallmentRepository;
        $this->salesOfficerRepo = $salesOfficerRepo;
    }
    public function index(Request $request)
    {
        $this->authorize(PermissionEnum::CLIENT(), [Client::class]);

        $salesOfficers = $this->salesOfficerRepo->getAllSalesOfficers();
        if ($request->has('query')) {
            $searcData = $request->all();
            $data = $this->clientRepository->search($searcData);
            $count = CountService::clientCount($data);
            return view("admin.client.index", compact("data", "salesOfficers", "searcData", "count"));
        }
        $data = $this->clientRepository->all();
        // dd($data);
        $count = CountService::clientCount($data);
        return view("admin.client.index", compact("data", "salesOfficers", "count"));
    }
    public function create()
    {
        $this->authorize(PermissionEnum::CLIENT_CREATE(), [Client::class]);

        $salesOfficers = $this->clientRepository->getSalesOfficers();
        return view("admin.client.create", compact("salesOfficers"));
    }
    public function store(StoreClientRequest $request)
    {
        $client =  $this->clientRepository->store($request->validated());

        if ($client) {
            return Redirect::route('client.index')->with("success", "Record Added Successfully");
        }
        return Redirect::route('client.index')->with("error", "Error in Adding Record ");
    }
    public function show($id)
    {
        $this->authorize(PermissionEnum::CLIENT_VIEW(), [Client::class]);

        $data = $this->clientRepository->show($id);
        return view('admin.client.show', compact('data'));
    }
    public function edit($id)
    {
        $this->authorize(PermissionEnum::CLIENT_EDIT(), [Client::class]);

        $data = $this->clientRepository->show($id);
        // dd($data);
        return view('admin.client.edit', compact('data'));
    }
    public function update(UpdateClientRequest $request, $id)
    {
        $client = $this->clientRepository->update($request->validated(), $id);
        if ($client) {
            return Redirect::route('client.index')->with("success", "Record Updated Successfully");
        }
        return Redirect::route('client.index')->with("error", "Error in Updating Record ");
    }
    public function delete($id)
    {
        $this->authorize(PermissionEnum::CLIENT_DELETE(), [Client::class]);

        $this->clientRepository->delete($id);
        return redirect('admin/client')->with('success', 'Record Deleted Successfully.');
    }
    public function getInstallments($id)
    {
        $this->authorize(PermissionEnum::CLIENT_INSTALLMENT_VIEW(), [Client::class]);

        $data = $this->clientRepository->getCashInstallments($id);
        $chequeInstallments = $data[1];
        $cashInstallments = $data[0];
        return view('admin.client.installments', compact('id', 'chequeInstallments', 'cashInstallments'));
    }
    public function installmentEdit($id, $installmentId)
    {
        $this->authorize(PermissionEnum::CLIENT_INSTALLMENT_EDIT(), [Client::class]);
        $data = $this->clientRepository->getCashInstallments($id);
        $chequeInstallments = $data[1];
        $cashInstallments = $data[0];
        return view('admin.client.editinstallments', compact('id', 'installmentId', 'chequeInstallments', 'cashInstallments'));
    }
    public function installmentUpdate(InstallmentStatusUpdateRequest $request, $id)
    {
        $this->authorize(PermissionEnum::CLIENT_INSTALLMENT_STATUS_EDIT(), [Client::class]);
        $installment = $this->clientRepository->updateInstallmentStatus($id, $request->validated());

        if ($installment) {
            return Redirect::route('client.installments', ['id' => $request->id])->with("success", "Installment Status Updated Successfully");
        }
        return Redirect::route('client.installments', ['id' => $request->id])->with("error", "Error in Updating Installment Status. ");
    }

    public function addNewCashInstallment(Request $data, $id)
    {
        $this->authorize(PermissionEnum::CLIENT_CASH_INSTALLMENT_ADD(), [Client::class]);

        $customCashInstallment = $this->plotInstallmentRepository->addCustomCashInstallment($data, $id);
        if ($customCashInstallment == false) {
            return redirect()->back()->with('error', 'Installment Amount Is More Than Total Amount.');
        } else {
            return redirect()->back()->with('success', 'Record Added Successfully.');
        }
    }
    public function addNewChequeInstallment(Request $data, $id)
    {
        $this->authorize(PermissionEnum::CLIENT_CHECK_INSTALLMENT_ADD(), [Client::class]);

        $customChequeInstallment = $this->plotInstallmentRepository->addCustomChequeInstallment($data, $id);
        if ($customChequeInstallment == false) {
            return redirect()->back()->with('error', 'Installment Amount Is More Than Total Amount.');
        } else {
            return redirect()->back()->with('success', 'Record Added Successfully.');
        }
    }

    public function deleteInstallment($id)
    {
        $this->authorize(PermissionEnum::CLIENT_INSTALLMENT_DELETE(), [Client::class]);

        $this->plotInstallmentRepository->delete($id);
        return redirect()->back()->with('success', 'Record Deleted Successfully.');
    }
    public function print($client_id, $installment_id)
    {
        $data = $this->clientRepository->show($client_id);
        $newInstallment = $this->plotInstallmentRepository->find($installment_id);
        return view('admin.client.print', compact('data', 'newInstallment'));
    }
    public function printAll($clientId)
    {
        $data = $this->clientRepository->show($clientId);
        return view('admin.client.print-all', compact('data'));
    }
}
