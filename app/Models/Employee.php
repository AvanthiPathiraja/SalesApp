<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\InvoiceReturn;
use App\Models\DistributorStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getFullNameAttribute()
    {
        return ucfirst($this->title) .' '.ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function distributor_stocks()
    {
        return $this->hasMany(DistributorStock::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function invoice_returns()
    {
        return $this->hasMany(InvoiceReturn::class);
    }

}
