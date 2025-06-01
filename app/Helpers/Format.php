<?php

namespace App\Helpers;

class Format
{
    public static function rupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }

    // public static function tanggal($date, $format = 'd-m-Y')
    // {
    //     return \Carbon\Carbon::parse($date)->format($format);
    // }

    // public static function formatWaktu($date, $format = 'H:i:s')
    // {
    //     return \Carbon\Carbon::parse($date)->format($format);
    // }
}
