<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum GeneralEnum: string
{
    use InvokableCases;

        // INSTALLMENT
    case CLIENT_PLOT_INSTALLMENT = 'CPI';
    case PURCHASE_PLOT_INSTALLMENT = 'PPI';


}