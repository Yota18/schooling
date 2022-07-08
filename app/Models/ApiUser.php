<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'is_active',
        'token',
        'ability',
    ];
}
