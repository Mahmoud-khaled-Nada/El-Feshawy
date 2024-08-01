<?php

namespace App\Models;

use App\Http\Traits\FileUpload;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Event extends Model
{
    use HasFactory, Translatable, FileUpload;

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
    ];

    public static function rules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.title'] = 'required|string|max:255';
            $rules[$locale . '.description'] = 'nullable|string';
        }
        $rules['date'] = 'required|date';
        $rules['location'] = 'nullable|string';
        return $rules;
    }

}
