<?php

namespace App\Models;

use App\Models\Sektor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subsektor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sektor_id',
        'nm_subsektor'
    ];

    public function sektor ()
    {
        return $this->belongsTo(Sektor::class);
    }
}
