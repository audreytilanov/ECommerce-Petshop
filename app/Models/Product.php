<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'slug',
        'price',
        'description',
        'product_rate',
        'stock',
        'weight',
        'status',
    ];

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function categories() {
        return $this->hasOne(ProductCategoryDetail::class, 'product_id', 'id');
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    public function discounts(){
        return $this->hasOne(Discount::class, 'product_id', 'id');
    }
}
