<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Generator
{
    public static function generateUniqueOtpCode($model, $colume_name)
    {
        do {
            $number = random_int(1000, 9999);
        } while ($model->where($colume_name, $number)->exists());

        return $number;
    }



    public static function generateRandomString($minLength = 50, $maxLength = 70)
    {
        $length = rand($minLength, $maxLength);
        return Str::random($length);
    }
}
