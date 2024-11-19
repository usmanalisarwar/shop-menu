<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemDetail extends Model
{
    use HasFactory;
    protected $fillable = ['menu_item_id', 'label', 'price'];
    
    public function getLabelAttribute($value)
    {
        return (string)$value;
    }
}
