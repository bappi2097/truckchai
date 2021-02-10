<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $fiullable = [
        "key", "value"
    ];
    public function productValue()
    {
        return $this->belongsTo(ProductValue::class, "product_type_id");
    }
}
