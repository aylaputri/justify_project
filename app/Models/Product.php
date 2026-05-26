<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_product';

    protected $table = 'products';

    protected $fillable = [

        'id_category',

        'product_name',

        'gender',

        'description',

    ];

    public function variants()
    {
        return $this->hasMany(
            ProductVariant::class,
            'id_product',
            'id_product'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            ProductCategories::class,
            'id_category',
            'id_category'
        );
    }
}