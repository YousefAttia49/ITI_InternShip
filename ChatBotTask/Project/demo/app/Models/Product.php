<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order_Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    //
    protected $fillable = ["name", "description", "price", "quantity", "category_id"];
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function order_items()
    {
        return $this->hasMany(Order_Item::class);
    }
}
