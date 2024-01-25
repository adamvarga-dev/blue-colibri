<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafeteria extends Model
{
    use HasFactory;

    protected $fillable = ['first', 'second', 'third', 'total'];

    protected $casts = [
        'first' => 'json',
        'second' => 'json',
        'third' => 'json',
    ];
}
