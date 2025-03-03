<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{    
    use HasFactory;

    protected $table = 'tabel_album';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_kecamatan',
        'id_album_kategori',
        'nama_foto',
        'file',
        'added',
        'edited',
        'add_by'
    ];

    // Relasi ke tabel Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    // Relasi ke tabel AlbumKategori
    public function albumKategori()
    {
        return $this->belongsTo(AlbumKategori::class, 'id_album_kategori', 'id_album_kategori');
    }

    // Relasi ke tabel User (user_login)
    public function user()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }
}
