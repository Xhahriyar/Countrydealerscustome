<?php
//<!-- this will deal with all the counts for all the section like client , sales officers etc -->
namespace App\Services;

use App\Models\PlotSalesOfficer;

class CountService
{
    public static function getCountForSalesForAllOfficers()
    {
        $totalSalesCount = PlotSalesOfficer::all()->count();
        // sales commission if cash
        $totalSalesCommission = PlotSalesOfficer::where('commission_type', '=', 'cash')->sum('commission_amount');
        // sales commission if percentage
        $totalSalesCommission = PlotSalesOfficer::where('commission_type', '=', 'percent')->with('client')->get();

        // Initialize a variable to hold the total commission
        $totalCommission = 0;

        // Loop through each sales officer entry
        foreach ($totalSalesCommission as $salesOfficer) {
            // Get the commission percentage
            $commissionPercentage = $salesOfficer->commission_amount; // e.g., 1 for 1%, 2 for 2%, etc.

            // Get the corresponding plot sale price from the related client
            $plotSalePrice = $salesOfficer->client->plot_sale_price; // Adjust this based on your relationship and actual field name

            // Calculate the commission for this entry
            $commission = ($commissionPercentage / 100) * $plotSalePrice;

            // Sum the commission to the total commission
            $totalCommission += $commission;
        }

        // Now $totalCommission holds the total commission for all sales officers
        return $totalCommission;


    }

    public static function getTotalDealsOfSalesOfficer($id)
    {
        return PlotSalesOfficer::where('sales_officer_id' , $id)->count();
    }
}
