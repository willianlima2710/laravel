<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_contrato';
    protected $table = 'contratos';
    protected $casts = [        
        'dt_inccontrato' => 'datetime:d/m/Y',
        'dt_fimcontrato' => 'datetime:d/m/Y',
        'dt_cancontrato' => 'datetime:d/m/Y',
        'dt_cobcontrato' => 'datetime:d/m/Y',
        'dt_termcarencia' => 'datetime:d/m/Y',        
        'dt_privencimento' => 'datetime:d/m/Y',
        'deleted_at'=> 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];            
}
