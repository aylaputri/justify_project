<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'id_product', 'id_product');
    }
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id_category', 'id_category');
    }
}