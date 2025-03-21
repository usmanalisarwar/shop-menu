<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceManagementDetail extends Model
{
    use HasFactory;
    protected $fillable = ['price_management_id','label', 'price'];
    
    public function priceManagement()
    {
        return $this->belongsTo(PriceManagement::class);
    }
}
