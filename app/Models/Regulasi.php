<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regulasi extends Model
{
    use HasFactory;
    
    protected $table = 'tabel_regulasi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_dokumen',
        'tanggal_disahkan',
        'file',
        'edited',
        'added',
        'add_by',
        'edit_by',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by', 'id_user');
    }
}
