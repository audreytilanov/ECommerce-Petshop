<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $fillable = [
        'id',
        'province_id',
        // 'province',
        // 'type',
        'city_name',
        'postal_code',
    ];

    public function cities(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
