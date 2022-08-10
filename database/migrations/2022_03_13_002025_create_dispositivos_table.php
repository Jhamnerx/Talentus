<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {

            $table->id();
            $table->string('imei');
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->boolean('of_client')->default(false);
            $table->foreign('modelo_id')->references('id')->on('modelos_dispositivos')->onDelete('set null');
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
        Schema::dropIfExists('dispositivos');
    }
}
