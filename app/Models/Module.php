<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'url',
        'active',
        'icon',
        'deleted_at',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function roleModules()
    {
        return $this->hasMany(RolePermission::class);
    }
}
