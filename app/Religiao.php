<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Religiao extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_religiao';
}
