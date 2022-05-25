<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'courier_id',
        'timeout',
        'address',
        'province_id',
        'total',
        'shipping_cost',
        'sub_total',
        'proof_of_payment',
        'city_id',
        'shipping_package',
        'status',
    ];

    public function couriers(){
        return $this->belongsTo(Courier::class, 'courier_id', 'id');
    }

    public function cities(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function provinces(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
