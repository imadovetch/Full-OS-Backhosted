<?php

use Illuminate\Support\Carbon;

function formatLocalizedWithSuffix($date)
{
    $carbonDate = Carbon::parse($date);
    $day = $carbonDate->format('jS');
    $monthYear = $carbonDate->format('F, Y');
    return "{$day} {$monthYear}";
}
