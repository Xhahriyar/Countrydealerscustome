<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\SalesOfficer;
use App\Repositories\PlotPaymentRepository;
use App\Repositories\PlotInstallmentRepo;
use App\Repositories\PlotSalesOfficersCommissionRepo;
use App\Repositories\OtherOwnersRepo;
class ClientRepository
{
    protected $model;
    protected $plotRepository;
    protected $plotInstallmentRepository;
    protected $PlotSalesOfficersCommissionRepo;
    protected $otherOwnersRepo;
    public function __construct(
        Client $model,
        PlotPaymentRepository $plotRepository,
        PlotInstallmentRepo $plotInstallmentRepository,
        PlotSalesOfficersCommissionRepo $PlotSalesOfficersCommissionRepo,
        OtherOwnersRepo $otherOwnersRepo,
    ) {
        $this->model = $model;
        $this->plotRepository = $plotRepository;
        $this->plotInstallmentRepository = $plotInstallmentRepository;
        $this->PlotSalesOfficersCommissionRepo = $PlotSalesOfficersCommissionRepo;
        $this->otherOwnersRepo = $otherOwnersRepo;
    }
    public function getSalesOfficers()
    {
        return SalesOfficer::all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    public function all()
    {
        return $this->model->with(['saleOfficers.officer', 'installments'])->get();
    }
    public function search($data)
    {
        // Get the input values from the form
        $salesOfficer = $data['sales_officer'] ?? '';
        $saleType = $data['sale_type'] ?? '';
        $fromDate = $data['from'] ?? '';
        $toDate = $data['to'] ?? '';

        // Build the query to fetch data based on filters
        $clients = $this->model::query();

        // Filter by Sales Officer if provided (using the relationship)
        if ($salesOfficer) {
            $clients->whereHas('saleOfficers', function ($query) use ($salesOfficer) {
                $query->whereHas('officer', function ($query) use ($salesOfficer) {
                    $query->where('id', $salesOfficer);
                });
            });
        }

        // Filter by Sale Type if provided
        if ($saleType) {
            $clients->where('sale_type', $saleType);
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
        $clients = $clients->with(['saleOfficers.officer', 'installments'])->get();
        return $clients;
    }
    public function getOldPlots()
    {
        return $this->model->select('id', 'number')->get();
    }
    public function store($data)
    {

        $client = [
            "email" => $data["email"],
            "name" => $data["name"],
            "cnic" => $data["cnic"],
            "number" => $data["number"],
            "father_or_husband_name" => $data["father_or_husband_name"],
            "paid_by" => $data["paid_by"],
            "plot_number" => $data["plot_number"],
            "location" => $data["location"],
            "plot_price" => $data["plot_price"],
            "plot_demand" => $data["plot_demand"],
            "plot_sale_price" => $data["plot_sale_price"],
            "client_type" => $data["client_type"],
            "sale_type" => $data["sale_type"],
            "agreement" => $data["agreement"],
            "vehicles_adjustment" => $data["vehicles_adjustment"],
            "adjustment_price" => $data["adjustment_price"],
            "advance_payment" => $data["advance_payment"],
            "plot_size" => $data["plot_size"],
        ];
        if (isset($data['adjustment_product']) && $data['adjustment_product']->isValid()) {
            $client['adjustment_product'] = $data['adjustment_product']->store('adjustmentproducts', 'public');
        }
        $client = $this->model->create($client);
        $clientId = $client->id;
        if (!empty($data['sales_officer_id'])) {
            $this->PlotSalesOfficersCommissionRepo->store($data, $clientId);
        }
        if (!empty($data['other_owner_name'])) {
            $this->otherOwnersRepo->store($data, $clientId);
        }
    }
    public function show($Id)
    {
        return $this->model->with(['installments', 'owners', 'payments', 'saleOfficers.officer'])->where('id', $Id)->first();
    }
    public function update($data, $Id)
    {
        $record = $this->model->find($Id);
        $client = [
            "email" => $data["email"],
            "name" => $data["name"],
            "cnic" => $data["cnic"],
            "number" => $data["number"],
            "father_or_husband_name" => $data["father_or_husband_name"],
            "paid_by" => $data["paid_by"],
            "plot_number" => $data["plot_number"],
            "location" => $data["location"],
            "plot_price" => $data["plot_price"],
            "plot_demand" => $data["plot_demand"],
            "plot_sale_price" => $data["plot_sale_price"],
            "client_type" => $data["client_type"],
            "sale_type" => $data["sale_type"],
            "vehicles_adjustment" => $data["vehicles_adjustment"],
            "adjustment_price" => $data["adjustment_price"],
            "advance_payment" => $data["advance_payment"],
            "plot_size" => $data["plot_size"],
        ];
        if (isset($data['adjustment_product']) && $data['adjustment_product']->isValid()) {
            $client['adjustment_product'] = $data['adjustment_product']->store('adjustmentproducts', 'public');
        }
        $record->update($client);
    }
    public function delete($id)
    {
        $this->find($id)->delete();
    }
    public function getCashInstallments($id)
    {
        return $this->plotInstallmentRepository->getCashInstallments($id);
    }
    public function updateInstallmentStatus($id)
    {
        return $this->plotInstallmentRepository->updateInstallmentStatus($id);
    }
}
