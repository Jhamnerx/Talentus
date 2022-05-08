<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculos_id');
            $table->string('numero');
            $table->date('inicio_cobertura');
            $table->date('fin_cobertura');
            $table->string('fecha');
            $table->unsignedBigInteger('ciudades_id');
            $table->year('year');
            $table->boolean('sello')->default(1);
            $table->boolean('fondo')->default(1);
            $table->boolean('estado')->default(true);
            $table->boolean('eliminado')->default(false);
            $table->unsignedBigInteger('empresa_id');


            $table->foreign('vehiculos_id')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->foreign('ciudades_id')->references('id')->on('ciudades')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actas');
    }
}
