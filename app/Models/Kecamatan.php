<?php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_kecamatan',
        'ket',
    ];

    public function desa ()
    {
        return $this->hasMany(Desa::class);
    }
}
