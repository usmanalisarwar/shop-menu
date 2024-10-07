<?php

namespace App\Enums;

enum RequestStatusEnum
{
    const Pending = 'Pending';
    const Approved = 'Approved';
    const Rejected = 'Rejected';

    public
    static function values()
    {
        return [
            self::Pending,
            self::Approved,
            self::Rejected,
        ];
    }
}


