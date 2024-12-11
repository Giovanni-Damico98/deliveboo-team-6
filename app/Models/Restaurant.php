<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


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
        'slug',
    ];

    // Metodo boot per creare automaticamente lo slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            $restaurant->slug = Str::slug($restaurant->name, '-');
        });

        static::updating(function ($restaurant) {
            $restaurant->slug = Str::slug($restaurant->name, '-');
        });
    }

    public function dishes(){
        return $this->hasMany(Dish::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}