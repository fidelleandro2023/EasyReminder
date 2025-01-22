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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Referencia al pago asociado de la tabla payments');
            $table->date('paid_date')
                ->comment('Fecha en la que se realizó el pago');
            $table->decimal('amount_paid', 10, 2)
                ->comment('Monto total que se pagó');
            $table->string('payment_method')
                ->comment('Método de pago utilizado, como tarjeta, efectivo, transferencia, etc.');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `payment_histories` COMMENT = 'Tabla que almacena el historial de pagos realizados, incluyendo detalles como la fecha, el monto pagado y el método de pago.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
