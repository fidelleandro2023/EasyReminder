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
        Schema::create('recurring_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_entity_id')
                ->constrained('service_entity')
                ->onDelete('cascade')
                ->comment('Referencia al servicio recurrente asociado.');
            $table->decimal('amount', 10, 2)
                ->comment('Monto aproximado o fijo del pago recurrente.');
            $table->enum('frequency', ['monthly', 'yearly', 'quarterly'])
                ->comment('Frecuencia del pago: mensual, anual o trimestral.');
            $table->date('start_date')->comment('Fecha de inicio del pago recurrente.');
            $table->date('end_date')->nullable()->comment('Fecha opcional de fin del pago recurrente.');
            $table->date('next_due_date')->nullable()->comment('Fecha calculada del próximo pago.');
            $table->enum('status', ['active', 'paused', 'completed'])
                ->default('active')
                ->comment('Estado del pago recurrente.');
            $table->timestamps();
            $table->softDeletes()->comment('Eliminación lógica del pago recurrente.');
        });
        DB::statement("ALTER TABLE `recurring_payments` COMMENT ''");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_payments');
    }
};
