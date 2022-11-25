<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regioes extends Model
{    
    use SoftDeletes;
    protected $primaryKey = 'id_regiao';
}
