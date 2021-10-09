<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\InvoiceItem;
use App\Models\InvoicePayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Employee::class,'distributor_id');
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

    public function invoice_returns()
    {
        return $this->hasMany(InvoiceReturn::class);
    }

}
