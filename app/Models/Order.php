<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //Un pedido puede tener varios productos
    public function products() {
        return $this->belongsToMany(Product::class, 'order_product')->withTimestamps();
    }

    //Cada pedido solo puede tener una dirección
    public function address(){
        return $this->belongsTo(Address::class, 'address_id');
    }

    //Dirección de facturación que apunta a la misma tabla de direcciones
    public function billingAddress(){
        return $this->belongsTo(Address::class, 'address_f_id');
    }
    
    public function payment() {
        return $this->belongsTo(Payment::class);
    }

}
