<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capela extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_capela';     
    protected $casts = [        
        'deleted_at' => 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];                     
}
