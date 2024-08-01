<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Http\Traits\FileUpload;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory, Translatable, FileUpload;

    protected $fillable = [
        'title', 'start_date', 'end_date', 'duration', 'participants', 'status',
        'description', 'received_file_path', 'uploaded_file_path'
    ];

    public $translatedAttributes = ['title', 'description'];

    public static function rules()
    {
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'duration' => 'nullable|integer',
            'status' => 'nullable|in:pending,done',
            'participants' => 'nullable|integer',
            'received_file' => 'nullable|file',
            'employee_ids' => 'required|array|exists:employees,id',
            'checklist_items' => 'nullable|array|max:255',
        ];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules["{$locale}.title"] = 'required|string|max:255';
            $rules["{$locale}.description"] = 'nullable|string';
        }

        return $rules;
    }

    public function setReceivedFilePathAttribute($value)
    {
        $path = Constants::TASKS_FILES_PATH->value;
        $string = Str::random(10);
        $fileName = time() . $string . '.' . $value->getClientOriginalExtension();
        $filePath = $this->uploadImage($value, $fileName, $path);
        $this->attributes['received_file_path'] = $filePath;
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_task_assignments');
    }

    public function taskChecklistItems()
    {
        return $this->hasMany(TaskChecklistItem::class);
    }
}
