<?php

namespace App\Providers;

use App\Models\PlotInstallment;
use App\Models\PurchasePlotInstallments;
use App\Observers\PlotInstallmentObserver;
use App\Observers\PurchasePlotInstallmentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PlotInstallment::observe(PlotInstallmentObserver::class);
        PurchasePlotInstallments::observe(PurchasePlotInstallmentObserver::class);

    }
}
