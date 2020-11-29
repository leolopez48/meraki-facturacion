<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    protected $table = 'telefonos';

    protected $fillable = [
        'id_telefono', 'telefono', 'id_cliente', 'updated_at', 'created_at'
    ];

    protected $dateFormat = 'U';

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s'
    ];
}
