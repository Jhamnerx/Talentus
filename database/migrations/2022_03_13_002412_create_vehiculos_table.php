<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('motor')->nullable();
            $table->string('serie')->nullable();
            $table->unsignedBigInteger('sim_card_id');
            $table->string('numero')->unique()->nullable();
            $table->unsignedBigInteger('flotas_id');
            $table->unsignedBigInteger('dispositivos_id');
            $table->unsignedBigInteger('empresa_id');
            $table->enum('estado', [1, 2])->default(1);
            $table->boolean('is_active')->default(true);
            $table->boolean('eliminado')->default(false);

            $table->foreign('flotas_id')->references('id')->on('flotas')->onDelete('cascade');
            $table->foreign('dispositivos_id')->references('id')->on('dispositivos')->onDelete('cascade');
            $table->foreign('sim_card_id')->references('id')->on('sim_card')->onDelete('cascade');



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
        Schema::dropIfExists('vehiculos');
    }
}
