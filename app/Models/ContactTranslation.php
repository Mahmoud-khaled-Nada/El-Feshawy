<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactTranslation extends Model
{
    use HasFactory;

    public $table = 'contact_translations';

    protected $guarded = [];
}
