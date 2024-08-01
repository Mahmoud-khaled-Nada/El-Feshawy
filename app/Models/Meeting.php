<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Meeting extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title', 'start_time', 'end_time', 'date', 'number_employees',
        'number_customers', 'status', 'link', 'location', 'description',
    ];

    public $translatedAttributes = ['title', 'description'];

    public static function rules()
    {
        $rules = [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'number_employees' => 'required|integer|max:20',
            'number_customers' => 'required|integer|max:20',
            'status' => 'required|in:Online,Offline',
            'link' => 'nullable|string',
            'location' => 'nullable|string',
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employees,id',
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id',
        ];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules[$locale . '.title'] = 'required|string|max:255';
            $rules[$locale . '.description'] = 'nullable|string';
        }

        return $rules;
    }

    public function participatingCustomers()
    {
        return $this->belongsToMany(Customer::class, 'customer_meeting_participations', 'meeting_id', 'customer_id');
    }

    public function participatingEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_meeting_participations', 'meeting_id', 'employee_id');
    }
}
