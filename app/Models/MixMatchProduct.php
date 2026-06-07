<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MixMatchProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'gender',
        'image',
        'katalog_id',
    ];
}