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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id()->comment('Identificador único del presupuesto');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Usuario al que pertenece el presupuesto');
            $table->string('name', 255)
                ->comment('Nombre del presupuesto, por ejemplo, "Gastos del hogar"');
            $table->text('description')->nullable()
                ->comment('Descripción detallada del presupuesto');
            $table->decimal('amount', 10, 2)
                ->comment('Monto total asignado para este presupuesto');
            $table->decimal('spent', 10, 2)->default(0)
                ->comment('Cantidad ya gastada dentro de este presupuesto');
            $table->date('start_date')->nullable()
                ->comment('Fecha de inicio del presupuesto');
            $table->date('end_date')->nullable()
                ->comment('Fecha de finalización del presupuesto');
            $table->enum('status', ['active', 'inactive'])->default('active')
                ->comment('Estado del presupuesto: activo o inactivo');
            $table->timestamps();
            $table->softDeletes()->comment('Eliminación lógica del presupuesto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
