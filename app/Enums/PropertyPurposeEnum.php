<?php

namespace App\Enums;

enum PropertyPurposeEnum
{
    const FOR_RENT = 'For Rent';
    const FOR_SALE = 'For Sale';

    public
    static function values()
    {
        return [
            self::FOR_RENT,
            self::FOR_SALE
        ];
    }

}


