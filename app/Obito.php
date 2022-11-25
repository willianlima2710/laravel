<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obito extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_obito'; 
    protected $casts = [        
        'dt_nascimento' => 'datetime:d/m/Y',
        'dt_falecimento' => 'datetime:d/m/Y',
        'dt_sepultamento' => 'datetime:d/m/Y',
        'dt_atendimento' => 'datetime:d/m/Y', 
        'hr_atendimento' => 'time:H:i:s',
        'hr_falecimento' => 'time:H:i:s',
        'hr_sepultamento' => 'time:H:i:s',
        'deleted_at'=> 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];
}
