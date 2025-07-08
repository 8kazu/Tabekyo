<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function menuSources()
    {
        return $this->hasMany(MenuSource::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
