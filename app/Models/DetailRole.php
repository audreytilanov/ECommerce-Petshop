<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'role_id',
    ];

    public function admins(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function roles(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}

