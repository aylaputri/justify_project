<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'id_variant';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_variant', 'id_variant');
    }
}