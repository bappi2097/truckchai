<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        "trip_id", "trip_bid_id", "user_id", "text", "url", "is_seen"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
