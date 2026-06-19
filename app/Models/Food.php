<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'foto',
        'stok',
        'harga',
        'jenis',
        'alamat',
        'latitude',
        'longitude',
        'pickup_time',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}