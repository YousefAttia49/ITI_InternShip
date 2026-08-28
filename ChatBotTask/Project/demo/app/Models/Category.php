<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Product;
use App\Models\Order;
class Category extends Model
{
    //
      use HasFactory;
     protected $fillable=["name" ,"description"]; // access data
    //  protected $guarded=["token"]; //   data that u can't have access

 function orders()
 {
    return $this->hasMany(Order::class);
 }
 function products()
 {
    return $this->hasMany(Product::class);
 }



}
