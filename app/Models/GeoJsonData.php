<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoJsonData extends Model
{
    use HasFactory;

    protected $fillable = [
        'geojson',
        'nama_geo',
        'warna_geo' 
    ];

    protected $casts = [
        'geojson' => 'array', 
    ];
}
