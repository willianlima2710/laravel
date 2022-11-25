<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculo extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_veiculo'; 
    protected $casts = [        
        'dt_vigencia' => 'datetime:d/m/Y',
        'dt_manutencao' => 'datetime:d/m/Y',
        'deleted_at'=> 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];    
}
