<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\InvoiceReturn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id','stock_id','unit_price','unit_discount','quantity','is_free'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function invoice_returns()
    {
        return $this->hasMany(InvoiceReturn::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }


}
