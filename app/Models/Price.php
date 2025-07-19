<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'sampah_id',
        'bank_sampah_id',
        'harga',
    ];

    /**
     * Get the sampah that owns this price
     */
    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }

    /**
     * Get the bank sampah that owns this price
     */
    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'bank_sampah_id');
    }
}
