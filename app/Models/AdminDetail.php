<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "uuid", "address", "whatsapp_no", "image", "is_super_admin"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
