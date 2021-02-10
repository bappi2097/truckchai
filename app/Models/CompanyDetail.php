<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "uuid", "address", "image", "account_name"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
