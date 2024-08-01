<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Http\Traits\FileUpload;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PagesContent extends Model
{
    use HasFactory, Translatable, FileUpload;

    public $table = 'pages_contents';

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'type',
        'image',
    ];

    public static function rules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.title'] = 'required|string';
            $rules[$locale . '.description'] = 'nullable|string';
        }
        $rules['image'] = 'required|image|mimes:png,jpg,jpeg|max:2048';
        $rules['type'] = 'required|string';
        return $rules;
    }

    public static function updaterules()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.title'] = 'nullable|string';
            $rules[$locale . '.description'] = 'nullable|string';
        }
        $rules['image'] = 'nullable|image|mimes:png,jpg,jpeg|max:2048';
        $rules['type'] = 'required|string';
        return $rules;
    }

    public function setImageAttribute($value)
    {
        $path = Constants::PAGES_CONTENT_PATH->value;
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $fileName = time() . '.' . $value->getClientOriginalExtension();
            $filePath = $this->uploadImage($value, $fileName, $path);
            $this->attributes['image'] = $filePath;
        } else {
            $this->attributes['image'] = $path . basename($value);
        }
    }

    public function getImageAttribute()
    {
        return asset('uploads/pages_content/' . $this->attributes['image']);
    }



    public function scopeNews(Builder $query)
    {
        return $query->where('type', '=', 'news');
    }

    public function scopeAboutUs(Builder $query)
    {
        return $query->where('type', '=', 'about_us');
    }

    public function scopeServices(Builder $query)
    {
        return $query->where('type', '=', 'services');
    }

    public function scopeOurPeople(Builder $query)
    {
        return $query->where('type', '=', 'our_people');
    }
}
