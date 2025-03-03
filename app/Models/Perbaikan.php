<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perbaikan extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'tabel_perbaikan';
    protected $primaryKey = 'id_perbaikan';
    public $timestamps = true;

    protected $fillable = [
        'id_data', 'paket_pekerjaan', 'anggaran', 'sumber_dana', 'pelaksana', 'no_kontrak',
        'nilai_kontrak', 'tgl_kontrak', 'jangka_waktu', 'tgl_mulai', 'tgl_selesai',
        'tahun', 'realisasi', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'lokasi'
    ];
}
