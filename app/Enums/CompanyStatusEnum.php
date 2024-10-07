<?php

namespace App\Enums;

enum CompanyStatusEnum
{
    const OWNER = 'Owner';
    const MANAGER = 'Manager';
    const EMPLOYEE = 'Employee';
    const CEO = 'CEO';

    public
    static function values()
    {
        return [
            self::OWNER,
            self::MANAGER,
            self::EMPLOYEE,
            self::CEO,
        ];
    }
}


