<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderproduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function orderDetails() {
        return $this->hasMany(OrderDetail::class, 'orderid');
    }

}
