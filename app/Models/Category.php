<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends MyModel
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id','name', 'slug', 'parent_id', 'status','order_no', 'uuid', 'created_by', 'updated_by', 'deleted_by'];


    public function __construct()
    {
        parent::__construct();

    }

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
protected static function booted()
{
    static::creating(function ($category) {
         
        $userId = self::getCurrentUserId();
        
        $category->slug = slug(Category::class, $category->name);
        $category->uuid = (string) Str::uuid();
        $category->user_id = $userId;
        $category->created_by = $userId;
        $category->updated_by = $userId;
    });

    static::updating(function ($category) {
       $userId = self::getCurrentUserId();
        $category->slug = slug(Category::class, $category->name, $category->id);
        $category->updated_by = $userId;
    });

    static::deleting(function ($category) {
        $userId = self::getCurrentUserId();
        $category->deleted_by = $userId;
        $category->saveQuietly();
    });
}

}
