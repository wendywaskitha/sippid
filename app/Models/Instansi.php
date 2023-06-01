<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_instansi',
        'alamat',
        'email',
        'tlp',
        'nm_kadis',
        'nip',
        'logo',
    ];
}
