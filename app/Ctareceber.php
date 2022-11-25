<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ctareceber extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_ctareceber';    
    protected $table = 'ctarecebers'; 
    protected $casts = [        
        'dt_vencimento' => 'datetime:d/m/Y',
        'dt_pagamento' => 'datetime:d/m/Y',
        'dt_carne'=> 'datetime:d/m/Y',
        'dt_rembanco'=> 'datetime:d/m/Y',
        'deleted_at' => 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];                 
}
