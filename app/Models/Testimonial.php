<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    /**
     * Get the parent testimonialable model (driver , customer, company).
     */
    public function testimonialable()
    {
        return $this->morphTo();
    }
}
