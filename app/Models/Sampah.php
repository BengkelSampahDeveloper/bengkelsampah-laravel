<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    protected $table = 'sampah';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'satuan',
    ];

    /**
     * Get the prices for this sampah
     */
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    /**
     * Get the categories that contain this sampah
     */
    public function getCategoriesAttribute()
    {
        return Category::whereJsonContains('sampah', $this->id)->get();
    }
}
