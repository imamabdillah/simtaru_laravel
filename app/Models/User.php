<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_login'; // Sesuaikan dengan tabel di database

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'user_name',
        'user_pass',
    ];

    protected $hidden = [
        'user_pass',
    ];
     public $timestamps = false;

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'id_user', 'id_user');
    }
}
