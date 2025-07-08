<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'shop_id',
        'source_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function menuSource()
    {
        return $this->belongsTo(MenuSource::class, 'source_id');
    }
}
