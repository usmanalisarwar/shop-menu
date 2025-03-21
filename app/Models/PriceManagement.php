<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceManagement extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'price_type', 'data', 'user_id', 'description'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In PriceManagement model
    public function details()
    {
        return $this->hasMany(PriceManagementDetail::class, 'price_management_id');
    }

}
