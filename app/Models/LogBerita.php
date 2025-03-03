<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogBerita extends Model
{
    use HasFactory;

    protected $table = 'log_berita';
    protected $primaryKey = 'id_log_berita';
    public $timestamps = false;

    protected $fillable = [
        'id_berita', 'activity', 'tgl', 'add_by'
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita', 'id_berita');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }
}
