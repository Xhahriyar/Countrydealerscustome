<?php

namespace App\Trait;

use Illuminate\Http\Request;

trait InstallmentCodeGenerateTrait
{
    /**
     * @param Request $request
     * @return $this|false|string
     */

    // case code generate function

    public function installmentCodeGenerate($installmentPrefix, $model)
    {
        $lastRecord = $model::latest('id')->first();

        if ($lastRecord) {
            $lastNumber = substr($lastRecord->id, -7);
            $newNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
            $installmentCode = $installmentPrefix . '-' . $newNumber;

        } else {
            $newNumber = '0000001';
            $installmentCode = $installmentPrefix . '-' . '0000001';
        }
        $model->code = $installmentCode;
        return $model->code;
    }
}
