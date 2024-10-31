<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id ','category_id', 'title', 'price','description','availability_status','prep_time','discount','size','order_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     public function images()
    {
        return $this->hasMany(MenuItemImage::class, 'menu_item_id');
    }
     
}
