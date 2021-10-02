<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscardedStock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
