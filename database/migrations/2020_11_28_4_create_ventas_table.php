<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->integer('id_venta');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_producto');
            $table->date('fecha_entrega')->nullable();
            $table->string('lugar_entrega', 150)->nullable();
            $table->integer('cantidad');
            $table->double('total')->nullable();
            $table->timestamps();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->primary(['id_venta', 'id_producto']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
