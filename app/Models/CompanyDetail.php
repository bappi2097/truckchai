<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "company_type_id", "uuid", "address", "image", "account_name",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class, "company_type_id");
    }

    public function trucks()
    {
        return $this->belongsToMany(Truck::class);
    }

    public function balanceDetail()
    {
        return $this->hasOne(BalanceDetail::class, "company_id");
    }

    public function validTrucks()
    {
        return $this->trucks->where("is_valid", 1);
    }

    public function hasTruck()
    {
        return !$this->trucks->isEmpty();
    }

    public function hasValidTruck()
    {
        return !$this->validTrucks()->isEmpty();
    }

    /**
     * Get the user's testimonial.
     */

    public function testimonial()
    {
        return $this->morphOne(Testimonial::class, 'testimonialable');
    }
    public function tripBids()
    {
        return $this->hasMany(TripBid::class);
    }
}
