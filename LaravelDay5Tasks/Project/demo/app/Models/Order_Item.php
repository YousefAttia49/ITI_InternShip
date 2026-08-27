<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class Order_Item extends Model
{
    //
    protected $table = 'order_items';
    protected $fillable = ["order_id", "product_id", "quantity", "price"];

    function order()
    {
        return $this->belongsTo(Order::class);
    }
    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
