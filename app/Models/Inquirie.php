<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquirie extends Model
{
    use HasFactory;

    protected $table = 'inquiries';

    protected $fillable = [
        'customer_id', 'second_phone', 'status', 'subject'
    ];

    public  static function rules()
    {
        return [
            'second_phone' => ['nullable', 'string', 'min:10', 'max:20'],
            'status' => ['required', 'in:appointment,contact'],
            'subject' => ['nullable', 'string'],
        ];
    }

   

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
