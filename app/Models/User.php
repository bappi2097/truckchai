<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function customer()
    {
        return $this->hasOne(CustomerDetail::class, "user_id");
    }

    public function company()
    {
        return $this->hasOne(CompanyDetail::class, "user_id");
    }

    public function admin()
    {
        return $this->hasOne(AdminDetail::class, "user_id");
    }

    public function driver()
    {
        return $this->hasOne(DriverDetail::class, "user_id");
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->latest();
    }

    public function hasNotification()
    {
        return !$this->notifications->where("is_seen", false)->isEmpty();
    }

    public function isCompany()
    {
        return $this->hasRole("company");
    }

    public function isCustomer()
    {
        return $this->hasRole("customer");
    }
    public function isDriver()
    {
        return $this->hasRole("driver");
    }

    public function setNotification($truck_id, $text = "", $url = "")
    {
        return $this->notifications()->save(new Notification([
            "truck_id" => $truck_id,
            "text" => $text,
            "url" => $url
        ]));
    }
}
