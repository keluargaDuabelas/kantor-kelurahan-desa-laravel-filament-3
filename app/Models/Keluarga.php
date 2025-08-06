<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keluarga extends Model
{
    use HasFactory;

     protected $guarded = [];

 public function penduduk()
{
    return $this->hasMany(Penduduk::class);
}
public function kematian()
{
    return $this->hasMany(Kematian::class);
}
public function kelahiran()
{
    return $this->hasMany(Kelahiran::class);
}
public function pindah()
{
    return $this->hasMany(Pindah::class);
}
public function datang()
{
    return $this->hasMany(Datang::class);
}
public function domisili()
{
    return $this->hasMany(Domisili::class);
}
}
