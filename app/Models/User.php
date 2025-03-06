<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

     protected $rememberTokenName = null;
     protected $keyType = 'int'; // Pastikan tipe primary key adalah integer
     protected $table = 'user_login';
     protected $primaryKey = 'id_user';
     public $timestamps = false;

    protected $fillable = [
        'user_name', 
        'user_pass', 
        'id_user',
    ];

    protected $hidden = [
        'user_pass'
    ];

    public function detail()
    {
        return $this->hasOne(UserDetail::class, 'id_user', 'id_user');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
