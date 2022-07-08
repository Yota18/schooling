<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppdb_registrations extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_ppdb',
        'student_id',
        'type',
        'status',
        
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function ppdb_payment()
    {
        return $this->belongsTo(ppdb_payment::class);
    }
}
