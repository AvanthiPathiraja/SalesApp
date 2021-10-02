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

    public function issue_items()
    {
        return $this->hasMany(IssueItem::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function issue_returns()
    {
        return $this->hasMany(IssueReturn::class);
    }

    public function invoice_returns()
    {
        return $this->hasMany(InvoiceReturn::class);
    }
}
