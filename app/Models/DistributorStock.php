<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistributorStock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function distributor()
    {
        return $this->belongsTo(Employee::class,'distributor_id');
    }

    public function invoice_item()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
