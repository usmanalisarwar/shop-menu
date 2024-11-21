<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'slug', 'parent_id', 'status','order_no'];

    // Define a parent relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Define a children relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(CategoryImage::class, 'category_id');
    }
 
}
