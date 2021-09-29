<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceReturn extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function distributor()
    {
        return $this->belongsTo(Employee::class,'distributor_id');
    }
    public function invoice_item()
    {
        return $this->belongsTo(InvoiceItem::class);
    }
}
