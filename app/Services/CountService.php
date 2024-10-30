<?php
//<!-- this will deal with all the counts for all the section like client , sales officers etc -->
namespace App\Services;

use App\Models\PlotSalesOfficer;

class CountService
{
    public static function getCountForSalesForAllOfficers()
    {
        $totalSalesCount = PlotSalesOfficer::all()->count();
        $totalPaidCommission = PlotSalesOfficer::where('commission_received_status' , 'PAID')->sum('commission_received');
        $totalPendingCommission = PlotSalesOfficer::where('commission_received_status' , 'PENDING')->sum('commission_received');
        return [$totalSalesCount , $totalPaidCommission , $totalPendingCommission];
    }

    public static function getCountDataForSalesOfficer($id)
    {
        $totalDeals = PlotSalesOfficer::where('sales_officer_id' , $id)->count();
        $totalCommission = PlotSalesOfficer::where('sales_officer_id' , $id)->where('commission_received_status' , '=' , 'PAID')->sum('commission_received');
        $totalPendingCommission = PlotSalesOfficer::where('sales_officer_id' , $id)->where('commission_received_status' , '=' , 'PENDING')->sum('commission_received');
        // dd($totalPendingCommission);
        return [$totalDeals , $totalCommission , $totalPendingCommission];
    }
}
