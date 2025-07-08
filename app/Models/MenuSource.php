<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'shop_id',
        'processed',
    ];

    protected $casts = [
        'processed' => 'boolean',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'source_id');
    }
}
