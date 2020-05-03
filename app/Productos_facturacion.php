<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos_facturacion extends Model
{
    //    
        protected $table = 'productos_facturacion';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
