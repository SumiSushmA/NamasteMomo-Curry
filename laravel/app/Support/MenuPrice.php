<?php

namespace App\Support;

class MenuPrice
{
    public static function format(float|int|string|null $price): string
    {
        $amount = (float) $price;
        $formatted = number_format($amount, 2);

        return rtrim(rtrim($formatted, '0'), '.');
    }
}
