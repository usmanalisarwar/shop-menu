<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(MenuImage::class, 'menu_id');
    }

}
