<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'customer_name',
        'email',
        'phone',
        'payment_method',
        'quantity',
        'price',
        'total',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
