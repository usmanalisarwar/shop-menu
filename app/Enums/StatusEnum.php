<?php

namespace App\Enums;

enum StatusEnum
{
    const ACTIVE = 'Active';
    const Inactive = 'Inactive';

    public
    static function values()
    {
        return [
            self::ACTIVE,
            self::Inactive
        ];
    }
}


