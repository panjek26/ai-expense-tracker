<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function formatIDR($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}