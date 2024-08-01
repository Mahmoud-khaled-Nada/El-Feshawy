<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
    ];


    protected $appends = ['avatar'];

    public function inquiry()
    {
        return $this->hasOne(Inquirie::class, 'customer_id', 'id');
    }



    public function getAvatarAttribute()
    {
        $profile = DB::table('customers_profile')->where('customer_id', $this->id)->first();
        return $profile ? $profile->avatar : null;
    }

    public function getSecondPhoneAttribute()
    {
        return $this->inquiry ? $this->inquiry->second_phone : null;
    }








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
}
