<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\DistributorStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getProductDetailsAttribute()
    {
        return ucfirst($this->category) .' - '.ucfirst($this->name);
    }

    public function getUnitDetailsAttribute()
    {
        return ucfirst($this->size) .''.ucfirst($this->metric).' - '.ucfirst($this->unit);
    }


    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function distributor_stocks()
    {
        return $this->hasMany(DistributorStock::class);
    }
}
