<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueReturn extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function issue_item()
    {
        return $this->belongsTo(IssueItem::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Employee::class,'distributor_id');
    }

}
