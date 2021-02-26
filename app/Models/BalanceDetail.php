<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "company_id", "trip_no", "balance"
    ];
    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, "company_id");
    }
}
