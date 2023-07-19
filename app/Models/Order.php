<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'product_size_flavor_id', 'shipping_address', 
    'quantity', 'total', 'payment_method', 'payment_status'];
}
