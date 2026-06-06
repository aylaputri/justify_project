<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ProductCategories;
use App\Models\ProductVariant;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_category',
        'product_name',
        'gender',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(
            ProductCategories::class,
            'id_category',
            'id_category'
        );
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'id_product', 'id_product');
    }
}