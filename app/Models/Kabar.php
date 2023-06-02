<?php

namespace App\Models;

use App\Models\User;
use App\Traits\HasOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kabar extends Model
{
    use HasFactory, HasOwner;

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
