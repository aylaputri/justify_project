<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'id_address';
    protected $fillable = [
        'id_user',
        'address_title',
        'complete_address',
        'city',
        'province',
        'postal_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_address', 'id_address');
    }
}