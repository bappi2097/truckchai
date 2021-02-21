<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "description", "worker"
    ];

    public function productValues()
    {
        return $this->hasMany(ProductValue::class, "product_id");
    }
    public function trip()
    {
        return $this->hasOne(Trip::class, "product_id");
    }
}
