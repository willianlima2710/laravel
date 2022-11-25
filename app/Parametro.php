<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parametro extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_parametro';        
}
