<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppdb_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_code',
        'ppdb_registrations_id',
        'payee',
        'method',
        'is_confirmed',
        'payment_proof',
        
    ];
    public function ppdb_registrations()
    {
        return $this->hasOne(ppdb_registrations::class);
    }

}
