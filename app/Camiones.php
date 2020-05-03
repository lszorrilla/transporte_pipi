<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camiones extends Model
{
    //
    protected $fillable = ['marca','modelo','ano','matricula','color','tipo'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
