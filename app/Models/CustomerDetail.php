<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "uuid", "address", "image"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function addressBooks()
    {
        return $this->hasMany(AddressBook::class, "customer_id");
    }
    public function trips()
    {
        return $this->hasMany(Trip::class, "customer_id");
    }

    public function notification()
    {
        return $this->trips->map(function ($trip) {
            return $trip->tripBids;
        });
    }
    /**
     * Get the user's testimonial.
     */

    public function testimonial()
    {
        return $this->morphOne(Testimonial::class, 'testimonialable');
    }
}
