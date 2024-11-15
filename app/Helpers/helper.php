<?php

use Carbon\Carbon;

function dateFormat($date, $format = 'd-m-Y'): string
{
    if ($date) {
        return Carbon::parse($date)->format($format);
    }
    return '00:00:0000';
}