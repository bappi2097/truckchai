<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_type_id", "product_id", "value"
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function productTypes()
    {
        return $this->belongsTo(ProductType::class, "product_type_id");
    }
}
