<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tipo_tareas', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->after('nombre');
            $table->boolean('afecta_mantenimiento')->default(false)->nullable()->after('descripcion');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_tareas', function (Blueprint $table) {
            //
        });
    }
};
