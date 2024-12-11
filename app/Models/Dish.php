<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use SoftDeletes;
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

    public function orders(){
        return $this->belongsToMany(Order::class)->withTimestamps();
    }


}
