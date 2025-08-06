<?php

namespace App\Models;

use App\Filament\Resources\EktpRequestsRelationManagerResource\RelationManagers\PendudukRelationManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function keluarga()
{
    return $this->belongsTo(Keluarga::class);
}

public function kematian()
{
    return $this->hasMany(Kematian::class);
}
public function domisili()
{
    return $this->hasMany(Domisili::class);
}
}
