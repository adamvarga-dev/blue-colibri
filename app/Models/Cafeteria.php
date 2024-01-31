<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafeteria extends Model
{
    use HasFactory;

    protected $fillable = ['first', 'second', 'third', 'first_sub', 'second_sub', 'third_sub', 'total'];

    protected $casts = [
        'first' => 'json',
        'second' => 'json',
        'third' => 'json',
    ];
}
