<?php

namespace App\Observers;

use App\Models\PurchasePlotInstallments;
use App\Enums\GeneralEnum;
use App\Trait\InstallmentCodeGenerateTrait;

class PurchasePlotInstallmentObserver
{
    use InstallmentCodeGenerateTrait;

    public function creating(PurchasePlotInstallments $purchasePlotInstallments)
    {
        $model = $purchasePlotInstallments;

        $installmentPrefix = GeneralEnum::PURCHASE_PLOT_INSTALLMENT(); 
        $caseCode = $this->installmentCodeGenerate($installmentPrefix, $model);
    }

    /**
     * Handle the PlotInstallment "created" event.
     */
    public function created(PurchasePlotInstallments $purchasePlotInstallments): void
    {
        //
    }

    /**
     * Handle the PlotInstallment "updated" event.
     */
    public function updated(PurchasePlotInstallments $purchasePlotInstallments): void
    {
        //
    }

    /**
     * Handle the PlotInstallment "deleted" event.
     */
    public function deleted(PurchasePlotInstallments $purchasePlotInstallments): void
    {
        //
    }

    /**
     * Handle the PurchasePlotInstallments "restored" event.
     */
    public function restored(PurchasePlotInstallments $purchasePlotInstallments): void
    {
        //
    }

    /**
     * Handle the PurchasePlotInstallments "force deleted" event.
     */
    public function forceDeleted(PurchasePlotInstallments $purchasePlotInstallments): void
    {
        //
    }
}
