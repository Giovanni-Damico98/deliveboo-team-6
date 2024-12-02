<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    // Specifica la tabella associata al Model
    protected $table = 'dishes';

    // Fillable
    protected $fillable = [
        'name',
        'description',
        'price',
        'restaurant_id',
        'visible',
        'image',
    ];
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
