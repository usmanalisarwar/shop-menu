<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
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
        'module_id',
        'deleted_at',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }


    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }
}
