<?php

namespace App\Models;

use App\Models\Product;
use App\Models\DistributorStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function distributor_stocks()
    {
        return $this->hasMany(DistributorStock::class);
    }
}
