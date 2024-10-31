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
        $data = $this->plotSalesOfficer::where("sales_officer_id" , $id)->with(['client' , 'officer'])->get();
        return $data;
    }
    public function updateCommissionStatus($id)
    {
        $data =  $this->plotSalesOfficer::find($id);
        $data->commission_received_status = 'PAID';
        $data->save();
    }
    public function delete($id)
    {
        return SalesOfficer::find($id)->delete();
    }
}
