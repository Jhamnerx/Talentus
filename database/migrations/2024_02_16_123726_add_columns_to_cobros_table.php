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
        Schema::table('cobros', function (Blueprint $table) {
            $table->date('fecha_inicio')->nullable()->after('observacion');
            $table->unsignedBigInteger('vehiculos_id')->nullable()->change();
            $table->decimal('monto_unidad', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cobros', function (Blueprint $table) {
            //
        });
    }
};
