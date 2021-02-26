<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverBalanceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "driver_id", "trip_no", "balance"
    ];
    public function driver()
    {
        return $this->belongsTo(DriverDetail::class, "driver_id");
    }
}
