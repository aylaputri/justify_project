<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $primaryKey = 'id_image';

    public $timestamps = false;

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant', 'id_variant');
    }
}