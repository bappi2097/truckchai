<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "company_id", "uuid", "address", "image", "nid", "license"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, "company_id");
    }
}
