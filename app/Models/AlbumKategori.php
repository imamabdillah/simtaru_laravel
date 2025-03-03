<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AlbumKategori extends Model
{
    use HasFactory;

    protected $table = 'tabel_album_kategori';
    protected $primaryKey = 'id_album_kategori';

    public $timestamps = true;
    protected $fillable = [
        'nama',
        'slug'
    ];

    protected static function boot() {
        parent::boot();
        static ::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }
}
