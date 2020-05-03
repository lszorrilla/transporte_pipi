<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc');
            $table->string('destino');
            $table->integer('precio');
            $table->integer('monto_total');
            $table->integer('id_cliente');
            $table->integer('id_usuario');
            $table->timestamps();
            $table->softDeletes();
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
