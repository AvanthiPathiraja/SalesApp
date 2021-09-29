<?php

namespace App\Models;

use App\Models\Route;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoice_payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }


}
