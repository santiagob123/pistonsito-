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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 50);
            $table->string('apellido', 50);

            $table->enum('tipo_documento', ['cc', 'ti', 'cxe', 'pasaporte'])
                ->comment('cc: Cédula de ciudadanía, ti: Tarjeta de identidad, cxe: Cédula de extranjería, pasaporte');

            $table->number('numero_documento', 20)->unique();

            $table->enum('tipo_servicio', ['cambio de aceite', 'revision general', 'mantenimiento general'])
                ->comment('Tipos de servicio ofrecidos');

            $table->date('dia')->index();
            $table->time('hora')->index();

            $table->timestamps();
            
            $table->unique(['dia', 'hora'], 'citas_dia_hora_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
