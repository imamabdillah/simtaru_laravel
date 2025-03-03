<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferensiIcon extends Model
{
    use HasFactory;

    protected $table = 'tabel_referensi_icon';
    protected $primaryKey = 'id_icon';
    public $timestamps = false;

    protected $fillable = [
        'nama_icon', 'id_opd', 'edited', 'added', 'is_delete', 'add_by', 'edit_by', 'delete_by', 'is_active'
    ];

    public function opd()
    {
        return $this->belongsTo(ReferensiOpd::class, 'id_opd', 'id_opd');
    }

    public function userAdded()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }

    public function userEdited()
    {
        return $this->belongsTo(User::class, 'edit_by', 'id_user');
    }

    public function userDeleted()
    {
        return $this->belongsTo(User::class, 'delete_by', 'id_user');
    }
}
