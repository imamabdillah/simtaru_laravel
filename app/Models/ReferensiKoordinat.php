<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferensiKoordinat extends Model
{

    use HasFactory;

    protected $table = 'tabel_referensi_koordinat';
    protected $primaryKey = 'id_koordinat';
    public $timestamps = false;

    protected $fillable = [
        'nama_koordinat', 'ket_koordinat', 'tipe_koordinat', 'koordinat', 'id_opd',
        'edited', 'added', 'is_delete', 'add_by', 'edit_by', 'delete_by', 'is_active', 'tmp_file_name'
    ];

    public function opd()
    {
        return $this->belongsTo(ReferensiOpd::class, 'id_opd', 'id_opd');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by', 'id_user');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'delete_by', 'id_user');
    }
}
