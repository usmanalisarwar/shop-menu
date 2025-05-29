<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MyModel extends Model
{
    public $userId;

    public function __construct()
    {
        parent::__construct();

        $this->userId = auth()->check() && auth()->user()->role_id != 1
            ? auth()->id()
            : null;
    }

    public static function getCurrentUserId()
    {
        return auth()->check() && auth()->user()->role_id != 1
            ? auth()->id()
            : null;
    }
}

