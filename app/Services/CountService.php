<?php
//<!-- this will deal with all the counts for all the section like client , sales officers etc -->
namespace App\Services;

use App\Models\PlotSalesOfficer;

class CountService
{
    public static function getCountForSalesForAllOfficers()
    {
        $totalSalesCount = PlotSalesOfficer::where('is_installment' , false)->count();
        $totalPaidCommission = PlotSalesOfficer::where('commission_received_status' , 'PAID')->sum('commission_received');
        $totalPendingCommission = PlotSalesOfficer::where('is_installment' , false)->where('commission_received_status' , 'PENDING')->sum('commission_received');
        return [$totalSalesCount , $totalPaidCommission , $totalPendingCommission];
    }

    public static function getCountDataForSalesOfficer($id)
    {
        //where id = salesofficerid
        $totalDeals = PlotSalesOfficer::where('is_installment' , false)->where('sales_officer_id' , $id)->count();
        $totalCommission = PlotSalesOfficer::where('sales_officer_id' , $id)->where('commission_received_status' , '=' , 'PAID')->sum('commission_received');
        $totalPendingCommission = PlotSalesOfficer::where('is_installment' , false)->where('sales_officer_id' , $id)->where('commission_received_status' , '=' , 'PENDING')->sum('commission_received');
        $totalRemainingCommission = PlotSalesOfficer::where('is_installment' , false)->where('sales_officer_id' , $id)->where('commission_received_status' , '=' , 'PENDING')->sum('commission_received');
        // dd($totalPendingCommission);
        return [$totalDeals , $totalCommission , $totalPendingCommission];
    }

    public static function getCountDataForInstallments($salesOfficerId)
    {
        $totalInstallments = PlotSalesOfficer::where('is_installment' , true)->where('sales_officer_id' , $salesOfficerId)->count();
        $totalApprovedInstallmentsPendingCommission = PlotSalesOfficer::where('is_installment' , true)->where('sales_officer_id' , $salesOfficerId)->where('commission_received_status' , 'PAID')->sum('commission_received');
        $totalApprovedInstallmentsApprovedCommission = PlotSalesOfficer::where('is_installment' , true)->where('sales_officer_id' , $salesOfficerId)->where('commission_received_status' , 'PENDING')->sum('commission_received');
        return [$totalInstallments , $totalApprovedInstallmentsPendingCommission , $totalApprovedInstallmentsApprovedCommission];
    }
}
