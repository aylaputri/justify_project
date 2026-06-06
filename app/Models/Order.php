<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_user',
        'id_address',
        'shipping_address',
        'total_product_price',
        'shipping_cost',
        'grand_total',
        'shipping_method',
        'payment_method',
        'status',
        'order_date',
        'tracking_number',
    ];

     public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'id_address', 'id_address');
    }
}