<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Http\Traits\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactRequest extends Model
{
    use HasFactory, FileUpload;

    protected $table = 'contact_requests';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'message', 'type', 'file',
    ];


    public static function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:150'],
            'last_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'type' => ['required', 'in:appointment,contact_us'],
            'message' => ['required', 'string', 'max:255'],
            'file' => ['nullable'],
        ];
    }

    public function setFileAttribute($value)
    {
        $path = Constants::CONTACT_REQUESTS_PATH->value;
        $fileName = time() . Str::random(10) . '.' . $value->getClientOriginalExtension();
        $fileName = $this->uploadImage($value, $fileName, $path);
        return $this->attributes['file'] = $fileName;
    }

    public function getFileAttribute()
    {
        $path = Constants::CONTACT_REQUESTS_PATH->value;
        return asset($path . $this->attributes['file']);
    }


    public function scopeAppointmentType(Builder $query)
    {
        return $query->where('type', '=', 'appointment');
    }

    public function scopeContactUsType(Builder $query)
    {
        return $query->where('type', '=', 'contact_us');
    }
}
