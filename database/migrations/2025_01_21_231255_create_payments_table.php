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
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->comment('Identificador único del pago');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Referencia al usuario que realiza el pago');
            $table->foreignId('service_entity_id')
                ->constrained('service_entity')
                ->onDelete('cascade')
                ->comment('Referencia al servicio asociado, como agua, luz, teléfono, etc.');
            $table->decimal('amount', 10, 2)
                ->comment('Monto total a pagar por el servicio');
            $table->date('due_date')
                ->comment('Fecha de vencimiento del pago');
            $table->enum('status', ['pending', 'paid', 'overdue'])
                ->default('pending')
                ->comment('Estado actual del pago: pendiente, pagado o vencido');
            $table->timestamps();
            $table->softDeletes()->comment('Fecha de eliminación lógica del pago');
        });

        DB::statement("ALTER TABLE `payments` COMMENT = 'Tabla que almacena los pagos asociados a diferentes servicios y usuarios, con información del estado, monto y fechas importantes.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
