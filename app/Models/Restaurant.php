<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    // Specifica la tabella associata al Model
    protected $table = 'restaurants';

    // Fillable
    protected $fillable = [
        'name',
        'address',
        'vat_number',
        'image',
        'user_id',
    ];
}