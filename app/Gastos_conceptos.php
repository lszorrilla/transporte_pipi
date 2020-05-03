<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gastos_conceptos extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
