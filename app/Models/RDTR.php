<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RDTR extends Model
{
    protected $table = 'db_rdtr';
    public $timestamps = false;
    protected $fillable = [
        'nilai_kolom_unik', 'kdb', 'klb', 'kdh', 'gsb', 'ktb', 'ktgbgn', 
        'bgnizn', 'bgntbt', 'bgnbst', 'bgntbs', 'ketrgn'
    ];
}
