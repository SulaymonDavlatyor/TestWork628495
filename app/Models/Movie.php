<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
