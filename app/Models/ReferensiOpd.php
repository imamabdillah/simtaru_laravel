<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferensiOpd extends Model
{
    use HasFactory;
    
    protected $table = 'tabel_referensi_opd';
    protected $primaryKey = 'id_opd';
    public $timestamps = false;

    protected $fillable = [
        'nama_opd',
        'edited',
        'added',
        'is_delete',
        'add_by',
        'edit_by',
        'delete_by',
        'is_active',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'add_by');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'delete_by');
    }

}
