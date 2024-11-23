<?php

namespace App\Repositories;

use App\Models\PlotSalesOfficer;
use Illuminate\Support\Facades\Validator;

class PlotSalesOfficersCommissionRepo
{
    protected $model;

    public function __construct(PlotSalesOfficer $model)
    {
        $this->model = $model;
    }
    public function store(array $data, $clientId)
    {
        $totalSalesOfficers = count($data['sales_officer_id']);
        $rules = [
            'sales_officer_id' => 'required',
            'commission_type' => 'required',
            'commission_amount' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("client.create")
                ->withErrors($validator)
                ->withInput();
        }

        // Get plot_sale_price, adjustment_price, and advance_payment values
        $plotSalePrice = $data['plot_sale_price'] ?? 0;

        // Determine commission base: either sum of adjustment & advance or the full plot_sale_price if both are zero
        for ($i = 0; $i < count($data['sales_officer_id']); $i++) {
            $commissionType = $data['commission_type'][$i];
            $commissionAmount = $data['commission_amount'][$i];
            // Initialize commission received to zero
            $commissionReceived = 0;
            // Calculate commission received based on the commission type
            if ($commissionType === 'percent') {
                // Calculate commission as a percentage of the commission base
                $commissionReceived = ($commissionAmount / 100) * $plotSalePrice;
            } else {
                // If the type is a fixed amount.
                $commissionReceived = $commissionAmount;
            }
            $salesOfficers = [
                "client_id" => $clientId,
                "sales_officer_id" => $data['sales_officer_id'][$i],
                "commission_type" => $commissionType,
                "commission_amount" => $commissionAmount,
                "commission_received" => $commissionReceived / $totalSalesOfficers,
                "commission_received_status" => 'PENDING',
            ];
            $this->model->create($salesOfficers);
        }
    }


}
