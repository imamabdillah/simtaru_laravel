<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiWidget extends Model
{
    use HasFactory;

    protected $table = 'tabel_api_widget';
    protected $primaryKey = 'id_api_widget';
    public $timestamps = true;

    protected $fillable = [
        'nama_app', 'url_app', 'access_token', 'api_token',
        'id_opd', 'id_user', 'nama_pemohon', 'url_map'
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'id_opd', 'id_opd');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
