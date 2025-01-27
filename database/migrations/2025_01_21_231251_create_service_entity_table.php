<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_entity', function (Blueprint $table) {
            $table->id()->comment('Identificador único del servicio');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('service_entity')
                ->nullOnDelete()
                ->comment('Referencia al servicio padre en caso de que sea una subcategoría');
            $table->string('name', 100)->comment('Nombre del servicio, por ejemplo: agua, luz, teléfono');
            $table->text('description')->nullable()->comment('Descripción del servicio para más detalles');
            $table->boolean('is_active')->default(true)->comment('Indica si el servicio está activo');
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE `service_entity` COMMENT = 'Tabla que almacena los diferentes tipos de servicios a los que se pueden asociar pagos o recordatorios.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_entity');
    }
};
