<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'category_id'
    ];

    public function categories(){
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
