<?php

use Carbon\Carbon;

function dateFormat($date, $format = 'd-m-Y'): string
{
    if ($date) {
        return Carbon::parse($date)->format($format);
    }
    return '00:00:0000';
}

function formatNumberWithCurrencyExtension($number) {
    if (!is_numeric($number) || $number == 0) {
        return '0';
    }

    $formattedNumber = number_format((int)$number);
    return $formattedNumber . ' PKR';
}

function convertMarlaToSqFt($sqFt, $marlaSizeInSqFt = 225)
{
    if(is_numeric($sqFt)){
        return $sqFt * $marlaSizeInSqFt;
    }
    return 'N/A';
}
