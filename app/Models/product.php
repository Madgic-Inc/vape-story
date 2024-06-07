<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        'name',
        'value',
        'stock',
        'description',
        'image'
    ];
}
