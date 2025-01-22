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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id()->comment('Identificador único del registro de auditoría');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->comment('Usuario que realizó la acción');
            $table->string('action')->comment('Acción realizada, por ejemplo: crear, actualizar, eliminar');
            $table->string('table_name')->nullable()->comment('Nombre de la tabla afectada');
            $table->json('details')->nullable()->comment('Detalles adicionales de la acción');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `audit_logs` COMMENT = 'Tabla que almacena registros de auditoría para monitorear acciones importantes dentro del sistema.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
