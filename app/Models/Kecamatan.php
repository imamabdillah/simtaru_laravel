<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'tabel_kecamatan';
    protected $primaryKey = 'id_kecamatan';
    public $timestamps = true;

    protected $fillable = ['nama'];
}
