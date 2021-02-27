<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        "admin_id", "title", "image", "description",
    ];
    public function blogCategories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }
}
