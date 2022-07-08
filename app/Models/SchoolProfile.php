<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npsn',
        'nss',
        'address',
        'website',
        'email',
        'whatsapp',
        'instagram',
        'facebook',
        'youtube',
        'image',
    ];
    
    protected $appends = ['image_url'] ;

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/' . $this->image),
        );
    }
}
