<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_detail';
    protected $primaryKey = 'id_user_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_user', 'nama', 'role', 'id_opd', 'is_active'
    ];
}
