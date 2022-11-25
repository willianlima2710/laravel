<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planoconta extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_planoconta';   

}
