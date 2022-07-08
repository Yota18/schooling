<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'classes_id',
        'subject_id',
        'teacher_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
