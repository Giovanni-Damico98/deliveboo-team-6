<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function dishes(){
        return $this->hasMany(Dish::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class)->withPivot('category');
    }
}
