<?php

namespace App\Enums;

enum VehiclePurposeEnum
{
    const FOR_RENT = 'For Rent';
    const FOR_SELL = 'For Sell';
    public static function values()
    {
        return [
            self::FOR_RENT,
            self::FOR_SELL,
        ];
    }

}


