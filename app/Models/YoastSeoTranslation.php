<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoastSeoTranslation extends Model
{
    use HasFactory;

    public $table = 'yoast_seo_translations';
    protected $guarded = [];
}
