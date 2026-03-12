<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['judul', 'harga', 'rating', 'gambar'];

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}