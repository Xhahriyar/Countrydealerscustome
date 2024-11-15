<?php
//<!-- this will deal with all the counts for all the section like client , sales officers etc -->
namespace App\Services;

use App\Models\History;
use App\Models\PlotSalesOfficer;

class CountService
{
    public static function getCountForSalesForAllOfficers()
    {
        $totalSalesCount = PlotSalesOfficer::where('is_installment', false)->count();
        $totalPaidCommission = PlotSalesOfficer::where('commission_received_status', 'PAID')->where('is_installment', true)->sum('commission_received');
        $totalPendingCommission = PlotSalesOfficer::where('is_installment', false)
            ->where('commission_received_status', 'PENDING')
            ->where('is_installment', false)
            ->sum('commission_received');
        $finalPendingCommission = $totalPendingCommission - $totalPaidCommission;
        if ($finalPendingCommission < 0) {
            $finalPendingCommission = 0;
        }
        $totalCommissions = PlotSalesOfficer::where('commission_received_status', 'PENDING')->where('is_installment', false)->sum('commission_received');
        return [$totalSalesCount, $totalPaidCommission, $finalPendingCommission, $totalCommissions];
    }

    public static function getCountDataForSalesOfficer($id)
    {
        //where id = salesofficerid
        $totalDeals = PlotSalesOfficer::where('is_installment', false)->where('sales_officer_id', $id)->count();
        $totalCommission = PlotSalesOfficer::where('sales_officer_id', $id)->where('commission_received_status', '=', 'PAID')->sum('commission_received');
        $totalPendingCommission = PlotSalesOfficer::where('is_installment', false)->where('sales_officer_id', $id)->where('commission_received_status', '=', 'PENDING')->sum('commission_received');
        $finalPendingCommission = $totalPendingCommission - $totalCommission;
        if ($finalPendingCommission < 0) {
            $finalPendingCommission = 0;
        }
        return [$totalDeals, $totalCommission, $finalPendingCommission, $totalPendingCommission];
    }
    public static function getCommissionDetails($id)
    {
        $totalCommission = PlotSalesOfficer::where([
            'is_installment' => false,
            'commission_received_status' => "PENDING",
            'sales_officer_id' => $id,
        ])->sum('commission_received');
        $approvedCommission = PlotSalesOfficer::where([
            'is_installment' => true,
            'commission_received_status' => "PAID",
            'sales_officer_id' => $id,
        ])->sum('commission_received');

        $pendingCommission = $totalCommission - $approvedCommission;
        return [$totalCommission, $approvedCommission, $pendingCommission];
    }
    public static function getCountDataForInstallments($salesOfficerId, $clientId)
    {
        $totalInstallments = PlotSalesOfficer::where('is_installment', true)->where('sales_officer_id', $salesOfficerId)->where('client_id', $clientId)->count();
        $totalApprovedCommission = PlotSalesOfficer::where('is_installment', true)->where('sales_officer_id', $salesOfficerId)->where('commission_received_status', 'PAID')->where('client_id', $clientId)->sum('commission_received');
        $totalpendingCommission = PlotSalesOfficer::where('is_installment', false)->where('sales_officer_id', $salesOfficerId)->where('commission_received_status', 'PENDING')->where('client_id', $clientId)->sum('commission_received');
        $totalCommission = PlotSalesOfficer::where('is_installment', false)->where('sales_officer_id', $salesOfficerId)->where('commission_received_status', 'PENDING')->where('client_id', $clientId)->first();
        return [$totalInstallments, $totalApprovedCommission, $totalpendingCommission - $totalApprovedCommission, $totalCommission];
    }

    public static function getCommissionDetailsForOneDeal($salesOfficerId, $clientId)
    {
        $totalApprovedInstallmentsPendingCommission = PlotSalesOfficer::where([
            'is_installment' => true,
            'sales_officer_id' => $salesOfficerId,
            'commission_received_status' => 'PAID',
            'client_id' => $clientId,
        ])->sum('commission_received');
        return $totalApprovedInstallmentsPendingCommission;
    }
    public static function getTotalCommissionAmountForOneDeal($salesOfficerId, $clientId)
    {
        $totalCommission = PlotSalesOfficer::where([
            'is_installment' => false,
            'sales_officer_id' => $salesOfficerId,
            'commission_received_status' => 'PENDING',
            'client_id' => $clientId,
        ])->first();
        return $totalCommission;
    }
    public static function clientCount($data)
    {
        $totalCount = $data->count();
        $totalReceivedAmount = 0;
        $totalSalesAmount = $data->sum('plot_sale_price');
        $adjustmentOrAdvanceAmount = $data->sum('adjustment_price') + $data->sum('advance_payment');
        foreach ($data as $key => $client) {
            $totalReceivedAmountCalc = $client->installments->where('status', '=', 'PAID')->sum('installment_payment') + $client->installments->where('status', '=', 'PAID')->sum('cheque_installment_amount');
            $totalReceivedAmount += $totalReceivedAmountCalc;
        }
        $totalPendingAmount = $totalSalesAmount - $totalReceivedAmount;
        return [$totalCount, $totalSalesAmount, $totalReceivedAmount + $adjustmentOrAdvanceAmount, $totalPendingAmount - $adjustmentOrAdvanceAmount];
    }
    public static function expenseCount($data)
    {
        $totalCount = $data->count();
        $totalExpense = $data->sum('amount');
        return [$totalCount , $totalExpense];
    }
    public static function purchaseCount($data)
    {
        $totalCount = $data->count();
        $totalReceivedAmount = 0;
        $totalSalesAmount = $data->sum('plot_sale_price');
        $adjustmentOrAdvanceAmount = $data->sum('adjustment_price') + $data->sum('advance_payment');
        foreach ($data as $key => $client) {
            $totalReceivedAmountCalc = $client->installments->where('status', '=', 'PAID')->sum('installment_payment') + $client->installments->where('status', '=', 'PAID')->sum('cheque_installment_amount');
            $totalReceivedAmount += $totalReceivedAmountCalc;
        }
        $totalPendingAmount = $totalSalesAmount - $totalReceivedAmount;
        return [$totalCount, $totalSalesAmount, $totalReceivedAmount + $adjustmentOrAdvanceAmount, $totalPendingAmount - $adjustmentOrAdvanceAmount];
    }
    public static function PayrollCount($data)
    {
        // dd($data);
        $totalCount = $data->count();
        $totalPayments = $data->sum(function ($employee) {
            return $employee->histories->sum(function ($history) {
                return $history->salary + $history->other_allowance;
            });
        });
        return [$totalCount , $totalPayments];
    }
    // getpayrolldetails
    public static function getLoanDetailsOfEmployee($id)
    {
        return History::where('employee_id' , $id)->sum('loan_return');
    }
}
