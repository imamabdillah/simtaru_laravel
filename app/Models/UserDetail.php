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
        'id_user',
        'nama',
        'role',
        'id_opd',
        'is_active',
        'no_ktp',
        'no_hp',
        'email',
        'alamat',
        'kecamatan',
        'desa',
        'is_delete',
        'ditambahkan_oleh', // Tambahkan ini
        'diupdate_oleh',    // Tambahkan ini jika diperlukan
    ];

    // di UserDetail.php
    public function opd()
    {
        return $this->belongsTo(ReferensiOpd::class, 'id_opd', 'id_opd');
    }



}
