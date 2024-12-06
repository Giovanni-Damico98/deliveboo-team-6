<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Specifica la tabella associata al Model
    protected $table = 'categories';

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }

    protected $fillable = [
        'name',
    ];
}