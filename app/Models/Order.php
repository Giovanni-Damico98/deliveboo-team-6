<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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
