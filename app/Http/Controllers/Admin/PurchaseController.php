<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Repositories\SalesOfficerRepo;
use App\Repositories\purchase\PurchaseRepository;
use App\Repositories\purchase\PurchasePlotInstallmentRepo;
use App\Repositories\ClientRepository;
use App\Services\CountService;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    protected $SalesOfficerRepo;
    protected $clientRepository;
    protected $PurchaseRepository;
    protected $PurchasePlotInstallmentRepo;
    public function __construct(SalesOfficerRepo $SalesOfficerRepo, PurchaseRepository $PurchaseRepository, PurchasePlotInstallmentRepo $PurchasePlotInstallmentRepo, ClientRepository $clientRepository)
    {
        $this->SalesOfficerRepo = $SalesOfficerRepo;
        $this->PurchaseRepository = $PurchaseRepository;
        $this->PurchasePlotInstallmentRepo = $PurchasePlotInstallmentRepo;
        $this->clientRepository = $clientRepository;
    }
    public function index(Request $request)
    {
        $this->authorize(PermissionEnum::PURCHASE(), [Purchase::class]);

        if ($request->has('query')) {
            $searchData = $request->all();
            $data = $this->PurchaseRepository->search($searchData);
            $count = CountService::purchaseCount($data);
            return view("admin.purchase.index", compact('data', 'count'));
        }
        $data = $this->PurchaseRepository->all();
        $count = CountService::purchaseCount($data);
        return view("admin.purchase.index", compact("data", "count"));
    }

    public function create()
    {
        $this->authorize(PermissionEnum::PURCHASE_CREATE(), [Purchase::class]);

        $oldPlots = $this->clientRepository->getOldPlots();
        // dd($oldPlots);
        $salesOfficers = $this->SalesOfficerRepo->all();
        return view("admin.purchase.create", data: compact('salesOfficers', 'oldPlots'));
    }
    public function show($id)
    {
        $this->authorize(PermissionEnum::PURCHASE_VIEW(), [Purchase::class]);

        $data = $this->PurchaseRepository->show($id);
        return view('admin.purchase.show', compact('data'));
    }
    public function store(StorePurchaseRequest $request)
    {
        $purchase = $this->PurchaseRepository->store($request->all());
        if ($purchase) {
            return Redirect::route('purchase.index')->with("success", "Record Added Successfully");
        }
        return Redirect::route('purchase.index')->with("error", "Error in Adding Record ");
    }
    public function edit($id)
    {
        $this->authorize(PermissionEnum::PURCHASE_EDIT(), [Purchase::class]);

        $data = $this->PurchaseRepository->show($id);
        return view('admin.purchase.edit', compact('data'));
    }

    public function update(UpdatePurchaseRequest $request, $id)
    {
        $purchase = $this->PurchaseRepository->update($request->all(), $id);
        if ($purchase) {
            return Redirect::route('purchase.index')->with("success", "Record Updated Successfully");
        }
        return Redirect::route('purchase.index')->with("error", "Error in Updating Record ");
    }
    public function delete($id)
    {
        $this->authorize(PermissionEnum::PURCHASE_DELETE(), [Purchase::class]);

        $this->PurchaseRepository->delete($id);
        return redirect()->back()->with('success', 'Record Deleted Successfully.');
    }

    // purchase installments
    public function getInstallments($id)
    {
        $this->authorize(PermissionEnum::PURCHASE_INSTALLMENT_VIEW(), [Purchase::class]);

        $data = $this->PurchaseRepository->getCashInstallments($id);
        $chequeInstallments = $data[1];
        $cashInstallments = $data[0];
        return view('admin.purchase.installments', compact('id', 'chequeInstallments', 'cashInstallments'));
    }

    public function addNewCashInstallment(Request $data, $id)
    {
        $this->authorize(PermissionEnum::PURCHASE_CASH_INSTALLMENT_ADD(), [Purchase::class]);
        
        $customCashInstallment = $this->PurchasePlotInstallmentRepo->addCustomCashInstallment($data, $id);
        if ($customCashInstallment == false) {
            return redirect()->back()->with('error', 'Installment Amount Is More Than Total Amount.');
        } else {
            return redirect()->back()->with('success', 'Record Added Successfully.');
        }
    }
    public function addNewChequeInstallment(Request $data, $id)
    {
        $this->authorize(PermissionEnum::PURCHASE_CHECK_INSTALLMENT_ADD(), [Purchase::class]);

        $customChequeInstallment = $this->PurchasePlotInstallmentRepo->addCustomChequeInstallment($data, $id);
        if ($customChequeInstallment == false) {
            return redirect()->back()->with('error', 'Installment Amount Is More Than Total Amount.');
        } else {
            return redirect()->back()->with('success', 'Record Added Successfully.');
        }
    }
    public function installmentUpdate($id)
    {
        $this->authorize(PermissionEnum::PURCHASE_INSTALLMENT_STATUS_EDIT(), [Purchase::class]);

        $data = $this->PurchasePlotInstallmentRepo->updateInstallmentStatus($id);
        return redirect()->back()->with('success', 'Status Update Successfully.');
    }

    public function print($client_id, $installment_id)
    {
        $data = $this->PurchaseRepository->show($client_id);
        $newInstallment = $this->PurchasePlotInstallmentRepo->find($installment_id);
        return view('admin.client.print', compact('data', 'newInstallment'));
    }
    public function getOldClient($client_id)
    {
        $data = $this->clientRepository->find($client_id);
        return response()->json(['data' => $data]);
    }
}
