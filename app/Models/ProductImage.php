<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $primaryKey = 'id_image';

    public $timestamps = false;

    protected $fillable = [
        'id_variant',
        'image_url',
        'is_main'
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant', 'id_variant');
    }
}