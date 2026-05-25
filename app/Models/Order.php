<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_user',
        'grand_total',
        'shipping_cost',
        'payment_method',
        'status',
    ];
}
