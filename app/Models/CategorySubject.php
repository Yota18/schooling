<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
