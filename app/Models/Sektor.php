<?php

namespace App\Models;

use App\Models\Subsektor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sektor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_sektors'
    ];

    public function subsektor ()
    {
        return $this->hasMany(Subsektor::class);
    }
}
