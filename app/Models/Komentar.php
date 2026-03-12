<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
   protected $fillable = ['foto_id', 'nama', 'komentar', 'balasan'];

public function foto()
{
    return $this->belongsTo(\App\Models\Foto::class);
}
}