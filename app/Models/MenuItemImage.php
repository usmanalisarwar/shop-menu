<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemImage extends Model
{
    use HasFactory;

    protected $fillable = ['menu_item_id', 'image', 'order_no'];

}
