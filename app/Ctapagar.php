<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ctapagar extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_ctapagar';    
    protected $table = 'ctapagars';  
    protected $dates = [
        'dt_vencimento',
        'dt_pagamento',
        'dt_movimento',
        'deleted_at',
        'created_at',
        'updated_at',
    ];                     
}
