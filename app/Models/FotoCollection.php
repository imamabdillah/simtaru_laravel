<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoCollection extends Model
{
    //
    use HasFactory;
    protected $table = 'tabel_foto_collection';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id_collection', 'folder', 'file', 'added', 'edited', 'add_by' 
    ];
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'id_collection', 'id_collection');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }
}
