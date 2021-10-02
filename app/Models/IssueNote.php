<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\IssueItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueNote extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function issue_items()
    {
        return $this->hasMany(IssueItem::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Employee::class,'distributor_id');
    }

}
