<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoicePayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function distributor()
    {
        return $this->belongsTo(Employee::class,'distributor_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
