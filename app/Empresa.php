<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;
    protected $table = 'pessoas'; 
    protected $primaryKey = 'id_pessoa';   
    protected $casts = [        
        'dt_nascimento' => 'datetime:d/m/Y',
        'dt_admissao' => 'datetime:d/m/Y',
        'deleted_at'=> 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];
}
