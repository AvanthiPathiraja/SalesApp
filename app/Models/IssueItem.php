<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Product;
use App\Models\IssueNote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueItem extends Model
{
    use HasFactory;
    protected $fillable = ['issue_note_id','product_id','stock_id','quantity'];

    public function issue_note()
    {
        return $this->belongsTo(IssueNote::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function distributor()
    {
        return $this->morphToMany(Employee::class,"distributable");
    }
}
