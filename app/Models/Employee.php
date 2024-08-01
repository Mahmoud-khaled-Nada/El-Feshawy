<?php

namespace App\Models;

use App\Http\Traits\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject

{
    use HasFactory, FileUpload;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'status',
        'fcm_token',
        'code',
        'fingerprint',
    ];

    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:employees,email,',
        'phone' => 'required|string|min:11|max:11|regex:/^01[0125][0-9]{8}$/|unique:employees,phone,',
        'confirm-password' => 'required_with:password|same:password',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        'status' => 'required|in:0,1',
    ];


    protected $appends = [
        'status_string',
    ];

    protected $hidden = [
        'password',
        'fingerprint',
    ];

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setImageAttribute($value)
    {
        $filename = time() . '.' . $value->getClientOriginalExtension();
        $this->attributes['image'] = $this->uploadImage($value, $filename, 'uploads/employees/');
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ? asset('uploads/employees/' . $this->attributes['image']) : asset('assets/media/avatars/blank.png');
    }

    public function getStatusStringAttribute()
    {
        return $this->status == 1 ? __('lang.active') : __('lang.inactive');
    }

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'employee_task_assignments');
    }
    
}
