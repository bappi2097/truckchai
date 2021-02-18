<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "uuid", "address", "image", "nid", "license", "truck_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function truck()
    {
        return $this->hasOne(Truck::class, "truck_id");
    }
}
