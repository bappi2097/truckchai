<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        "admin_id", "title", "image", "description", "slug", "summery"
    ];
    public $translatable = ['title', 'description', 'summery'];

    public function blogCategories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(AdminDetail::class);
    }
}
