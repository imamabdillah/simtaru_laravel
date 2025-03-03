<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'tabel_berita';
    protected $primaryKey = 'id_berita';
    public $timestamps = false;

    protected $fillable = [
        'judul', 'isi', 'slug', 'thumbnail_url', 'added', 'edited', 'add_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }
}
