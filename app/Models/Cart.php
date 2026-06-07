<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table      = 'carts';
    protected $primaryKey = 'id_cart';
    protected $fillable   = ['id_user', 'id_variant', 'quantity'];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant', 'id_variant');
    }
}