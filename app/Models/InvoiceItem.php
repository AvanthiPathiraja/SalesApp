<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\InvoiceReturn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id','distributor_stock_id','sold_price','discount','quantity'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function invoice_returns()
    {
        return $this->hasMany(InvoiceReturn::class);
    }

    public function distributor_stock()
    {
        return $this->belongsTo(DistributorStock::class);
    }
}
