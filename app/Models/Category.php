<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'category_restaurant','restaurant_id', 'category_id');
    }

    protected $fillable = [
        'name',
    ];
}