<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        "name", "slug"
    ];
    public $translatable = ['name'];
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}
