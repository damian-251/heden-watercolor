<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_translation() {
        return $this->hasMany(Product_tr::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_product');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_product');
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_product');
    }
}
