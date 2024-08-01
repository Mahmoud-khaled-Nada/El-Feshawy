<?php

namespace App\Models;

use App\Http\Traits\FileUpload;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Contact extends Model
{
    use HasFactory, Translatable, FileUpload;

    public $table = 'contacts';

    public $translatedAttributes = ['address', 'message'];

    protected $fillable = [
        'email',
        'phone',
        'facebook',
        'linkedin',
        'instagram',
        'X',
        'youtube',
        'location',
        'address',
        'message',
    ];
    public static function rules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.address'] = 'required|string';
            $rules[$locale . '.message'] = 'nullable|string';
        }
        $rules['email'] = 'required|string';
        $rules['phone'] = 'required|string';
        $rules['facebook'] = 'required|string';
        $rules['linkedin'] = 'required|string';
        $rules['instagram'] = 'required|string';
        $rules['X'] = 'required|string';
        $rules['youtube'] = 'required|string';
        $rules['location'] = 'required|string';
        return $rules;
    }

    public static function updaterules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.address'] = 'nullable|string';
            $rules[$locale . '.message'] = 'nullable|string';
        }
        $rules['email'] = 'nullable|string';
        $rules['phone'] = 'nullable|string';
        $rules['facebook'] = 'nullable|string';
        $rules['linkedin'] = 'nullable|string';
        $rules['instagram'] = 'nullable|string';
        $rules['X'] = 'nullable|string';
        $rules['youtube'] = 'nullable|string';
        $rules['location'] = 'nullable|string';
        return $rules;
    }
}
