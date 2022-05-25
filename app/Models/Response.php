<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id',
        'admin_id',
        'content',
    ];

    public function reviews(){
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }
}
