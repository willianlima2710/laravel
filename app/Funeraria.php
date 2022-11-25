<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funeraria extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_funeraria';    
    protected $table = 'funerarias';
    protected $casts = [        
        'deleted_at'=> 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];        
}
