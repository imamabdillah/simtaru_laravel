<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiWidgetLayer extends Model
{
    use HasFactory;

    protected $table = 'tabel_api_widget_layer';
    protected $primaryKey = 'id_api_widget_layer';
    public $timestamps = false;

    protected $fillable = [
        'id_api_widget', 'id_layer', 'created_at'
    ];

    public function apiWidget()
    {
        return $this->belongsTo(ApiWidget::class, 'id_api_widget', 'id_api_widget');
    }

    public function layer()
    {
        return $this->belongsTo(Layer::class, 'id_layer', 'id_layer');
    }
}
