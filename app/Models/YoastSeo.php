<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class YoastSeo extends Model
{
    use HasFactory, Translatable;

    public $table = 'yoast_seos';

    public $translatedAttributes = [ 'seo_title', 'seo_description', 'seo_keywords'];

    protected $fillable = ['seo_title', 'seo_description', 'seo_keywords'];


    public static function rules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.seo_title'] = 'required|string';
            $rules[$locale . '.seo_description'] = 'required|string';
            $rules[$locale . '.seo_keywords'] = 'required|string';
        }
        return $rules;
    }
}
