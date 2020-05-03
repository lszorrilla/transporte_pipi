<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referencia_laboral extends Model
{
    //

    protected $table = 'empleados_referencias_laboral';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
