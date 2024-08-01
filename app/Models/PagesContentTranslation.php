<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesContentTranslation extends Model
{
    use HasFactory;

    public $table = 'pages_content_translations';

    protected $guarded = [];
}
