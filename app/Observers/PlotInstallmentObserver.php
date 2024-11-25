<?php

namespace App\Observers;

use App\Models\PlotInstallment;
use App\Enums\GeneralEnum;
use App\Trait\InstallmentCodeGenerateTrait;

class PlotInstallmentObserver
{
    use InstallmentCodeGenerateTrait;

    public function creating(PlotInstallment $plotInstallment)
    {
        $model = $plotInstallment;

        $installmentPrefix = GeneralEnum::CLIENT_PLOT_INSTALLMENT(); 
        $caseCode = $this->installmentCodeGenerate($installmentPrefix, $model);
    }

    /**
     * Handle the PlotInstallment "created" event.
     */
    public function created(PlotInstallment $plotInstallment): void
    {
        //
    }

    /**
     * Handle the PlotInstallment "updated" event.
     */
    public function updated(PlotInstallment $plotInstallment): void
    {
        //
    }

    /**
     * Handle the PlotInstallment "deleted" event.
     */
    public function deleted(PlotInstallment $plotInstallment): void
    {
        //
    }

    /**
     * Handle the PlotInstallment "restored" event.
     */
    public function restored(PlotInstallment $plotInstallment): void
    {
        //
    }

    /**
     * Handle the PlotInstallment "force deleted" event.
     */
    public function forceDeleted(PlotInstallment $plotInstallment): void
    {
        //
    }
}
