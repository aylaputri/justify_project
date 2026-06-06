<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'id_variant';
    protected $fillable = [
        'id_product',
        'color',
        'size',
        'price',
        'stock',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_variant', 'id_variant');
    }
}