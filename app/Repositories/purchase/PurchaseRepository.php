<?php

namespace App\Repositories\purchase;

use App\Models\Purchase;
use App\Repositories\purchase\FullPurchaseRepository;
use App\Repositories\purchase\PurchasePlotInstallmentRepo;
use App\Repositories\purchase\PurchasePlotOwners;
use App\Repositories\purchase\PurchasePlotSalesOfficerRepo;
use App\Trait\SetLoggedUserDataTrait;

class PurchaseRepository
{
    use SetLoggedUserDataTrait;
    protected $model;
    protected $fullPurchaseRepository;
    protected $PurchasePlotInstallmentRepo;
    protected $PurchasePlotOwners;
    protected $PurchasePlotSalesOfficerRepo;
    public function __construct(
        Purchase $model,
        FullPurchaseRepository $fullPurchaseRepository,
        PurchasePlotInstallmentRepo $PurchasePlotInstallmentRepo,
        PurchasePlotSalesOfficerRepo $PurchasePlotSalesOfficerRepo,
        PurchasePlotOwners $PurchasePlotOwners,
    ) {
        $this->model = $model;
        $this->fullPurchaseRepository = $fullPurchaseRepository;
        $this->PurchasePlotInstallmentRepo = $PurchasePlotInstallmentRepo;
        $this->PurchasePlotSalesOfficerRepo = $PurchasePlotSalesOfficerRepo;
        $this->PurchasePlotOwners = $PurchasePlotOwners;
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function all()
    {
        return $this->model::with('installments')->get();
    }
    public function store($data)
    {
        $purchase = [
            "email" => $data["email"],
            "name" => $data["name"],
            "cnic" => $data["cnic"],
            "contact_no" => $data["contact_no"],
            "father_or_husband_name" => $data["father_or_husband_name"],
            "paid_by" => $data["paid_by"],
            "plot_number" => $data["plot_number"],
            "address" => $data["address"],
            "plot_sale_price" => $data["plot_sale_price"],
            "client_type" => $data["client_type"],
            "sale_type" => $data["sale_type"],
            "vehicles_adjustment" => $data["vehicles_adjustment"],
            "adjustment_price" => $data["adjustment_price"],
            "advance_payment" => $data["advance_payment"],
            "plot_size" => $data["plot_size"],
            "date" => $data["date"],
            "last_date_to_clear_payment" => $data["last_date_to_clear_payment"],
        ];
        if (isset($data['adjustment_product']) && $data['adjustment_product']->isValid()) {
            $client['adjustment_product'] = $data['adjustment_product']->store('adjustmentproducts', 'public');
        }
        $purchase = $this->setLoggedUserData($purchase);
        $purchase = $this->model->create($purchase);
        $purchaseId = $purchase->id;
        // if payment is full
        // if ($data['payment_type'] == 'yes') {
        //     $this->fullPurchaseRepository->store($data, $purchaseId);
        //     // if payment is in installments
        // } else {
        //     $this->PurchasePlotInstallmentRepo->store($data, $purchaseId);
        // }
        if (!empty($data['sales_officer_id'])) {
            $this->PurchasePlotSalesOfficerRepo->store($data, $purchaseId);
        }
        if (!empty($data['other_owner_name'])) {
            $this->PurchasePlotOwners->store($data, $purchaseId);
        }
        return $purchase;
    }
    public function show($Id)
    {
        return $this->model->with(['installments', 'owners', 'payments', 'saleOfficers.officer'])->where('id', $Id)->first();
    }
    public function update($data, $Id)
    {
        $record = $this->model->find($Id);
        if (isset($data['adjustment_product']) && $data['adjustment_product']->isValid()) {
            $data['adjustment_product'] = $data['adjustment_product']->store('adjustmentproducts', 'public');
        }
        return $record->update($data);
    }
    public function delete($Id)
    {
        $this->model->find($Id)->delete();
    }
    public function getCashInstallments($id)
    {
        return $this->PurchasePlotInstallmentRepo->getCashInstallments($id);
    }
    public function search($data)
    {
        // Get the input values from the form
        $purchaseType = $data['purchase_type'] ?? '';
        $saleType = $data['sale_type'] ?? '';
        $fromDate = $data['from'] ?? '';
        $toDate = $data['to'] ?? '';

        // Build the query to fetch data based on filters
        $clients = $this->model::query();

        // Filter by Sales Officer if provided (using the relationship)

        // Filter by Sale Type if provided
        if ($saleType) {
            $clients->where('sale_type', $saleType);
        }
        if ($purchaseType) {
            $clients->where('client_type', $purchaseType);
        }

        // Filter by From Date if provided
        if ($fromDate) {
            $clients->whereDate('created_at', '>=', $fromDate);
        }

        // Filter by To Date if provided
        if ($toDate) {
            $clients->whereDate('created_at', '<=', $toDate);
        }

        // Get the filtered clients
        $clients = $clients->with('installments')->get();
        return $clients;
    }
}
