<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caixa extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_caixa';    
    protected $table = 'caixas';    
    protected $casts = [        
        'dt_vencimento' => 'datetime:d/m/Y',
        'dt_pagamento' => 'datetime:d/m/Y',
        'dt_movimento'=> 'datetime:d/m/Y',
        'deleted_at' => 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];                
}
