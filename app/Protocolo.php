<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protocolo extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_protocolo';
    protected $table = 'protocolos';
    protected $dates = [
        'dt_protocolo',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
