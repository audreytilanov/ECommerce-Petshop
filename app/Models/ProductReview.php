<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'rate',
        'content',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function responses(){
        return $this->hasOne(Response::class, 'review_id', 'id');
    }
}
