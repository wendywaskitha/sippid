<?php

namespace App\Models;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan_id',
        'nm_desa',
        'ket',
    ];

    public function kecamatan ()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
