<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingTracking extends Model
{
    use HasFactory;
    protected $table = 'shipping_tracking';
    protected $fillable = ['order_id', 'location', 'status', 'delivery_person_id'];
}
