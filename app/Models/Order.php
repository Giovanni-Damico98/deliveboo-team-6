<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'total_price',
        'firstname',
        'lastname',
        'address',
        'phone_number',
        'note',
    ];


    public function dishes(){
        return $this->belongsToMany(Dish::class)->withTimestamps();
    }

}
