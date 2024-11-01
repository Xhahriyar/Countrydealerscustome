<?php

namespace App\Repositories;

use App\Models\PlotSalesOfficer;
use App\Models\SalesOfficer;

class SalesOfficerRepo
{
    protected $model;
    protected $plotSalesOfficer;

    public function __construct(SalesOfficer $model , PlotSalesOfficer $plotSalesOfficer)
    {
        $this->model = $model;
        $this->plotSalesOfficer = $plotSalesOfficer;
    }
    public function all()
    {
        return $this->model::with('deals.client')->get();
    }
    public function store($data)
    {
        return $this->model::create($data);
    }
    public function getAllDealsDetails($id)
    {
        $data = $this->plotSalesOfficer::where('is_installment' , false)->where("sales_officer_id" , $id)->with(['client' , 'officer'])->get();
        return $data;
    }
    public function updateCommissionStatus($id)
    {
        $data =  $this->plotSalesOfficer::find($id);
        $data->commission_received_status = 'PAID';
        $data->save();
        return 0;
    }
    public function updateInstallmentCommissionStatus($Installmentid , $salesOfficerId , $clientId)
    {
        $data =  $this->plotSalesOfficer::find($Installmentid);
        $sale = $this->plotSalesOfficer::where('sales_officer_id' , $salesOfficerId)->where('is_installment' , false)->where('client_id' , $clientId)->first();
        $sale->commission_received = $sale->commission_received - $data->commission_received;
        $data->commission_received_status = 'PAID';
        $data->save();
        $sale->save();
        return 0 ;
    }
    public function getAllInstallmentsDetails($id , $clientId)
    {
        $data =  $this->plotSalesOfficer::where('is_installment' , true)->where("sales_officer_id" , $id)->where('client_id' , $clientId)->get();
        // dd($data);
       return $data;
    }
    public function delete($id)
    {
        return SalesOfficer::find($id)->delete();
    }
}
