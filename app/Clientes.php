<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Clientes extends Model
{
   protected $fillable = ['nombre','apellido','direccion','telefono','correo','RNC','NCF','user_id'];
   use SoftDeletes;
    protected $dates = ['deleted_at'];
}
