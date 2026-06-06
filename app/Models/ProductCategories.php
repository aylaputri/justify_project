<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    protected $table = 'product_categories';

    protected $primaryKey = 'id_category';

    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    public function products()
    {
        return $this->hasMany(
            Product::class,
            'id_category',
            'id_category'
        );
    }

    public function sizeCharts()
    {
        return $this->hasMany(
            SizeChart::class,
            'id_category',
            'id_category'
        );
    }
}