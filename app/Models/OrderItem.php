<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_order_item';
    protected $fillable = [
        'id_order', 'id_variant', 'price_at_purchase', 'quantity',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant', 'id_variant');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
}