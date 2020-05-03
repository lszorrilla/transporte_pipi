<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Camion_Factura extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
