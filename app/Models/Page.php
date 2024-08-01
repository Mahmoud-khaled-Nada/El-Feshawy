<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Page extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'content',
    ];

    public $translatedAttributes = [
        'title',
        'content',
    ];

    public static function rules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.content'] = 'required|string';
        }
        return $rules;
    }
}
