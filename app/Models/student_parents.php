<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_parents extends Model
{
    use HasFactory;
    protected $fillable = [
        'father_fullname',
        'father_birthyear',
        'father_education',
        'father_occupation',
        'father_salary',
        'mother_fullname',
        'mother_birthyear',
        'mother_education',
        'mother_occupation',
        'mother_salary',
        
    ];
    public function student()
    {
        return $this->hasOne(Student::class);
    }

}
