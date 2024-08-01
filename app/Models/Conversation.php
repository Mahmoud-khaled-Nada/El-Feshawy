<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'employee_id', 
        'last_message', 
        'last_message_send_at',
        'is_admin_read',
        'is_employee_read'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->select([
            'id', 
            'name', 
            'email', 
            'image'
        ]);
    }
}
