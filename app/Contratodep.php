<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contratodep extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_contratodep';    
    protected $table = 'contratos_dep';
    protected $dates = [
        'dt_nascimento',
        'dt_falecimento',
        'dt_sepultamento',
        'deleted_at',
        'created_at',
        'updated_at',
    ];                     
}
