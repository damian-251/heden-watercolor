<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function user() { //belongsto en la tabla que tiene la fk
        return $this->belongsTo(User::class);
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }

}
