<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nisn',
        'user_id',
        'classes_id',
        'gender',
        'birthdate',
        'birthplace',
        'phone',
        'address',
        'religion',
        'generation',
        'alumni',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }
    public function ppdb()
    {
        return $this->hasOne(ppdb_registrations::class);
    }
    public function parents()
    {
        return $this->belongsTo(student_parents::class);
    }

    public function scopeNotAlumni($query)
    {
        $query->where('alumni', 0);
    }
    public function scopeAlumni($query)
    {
        $query->where('alumni', 1);
    }
}
