<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeChart extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'id_size_chart';

    protected $fillable = [
        'id_category',
        'size',
        'length_cm',
        'width_cm'
    ];
}