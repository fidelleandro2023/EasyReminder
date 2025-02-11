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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id()->comment('Identificador único del recordatorio');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Referencia al usuario que creó el recordatorio');

            $table->foreignId('payment_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->comment('Referencia al pago único asociado (si aplica)');

            $table->foreignId('recurring_payment_id')
                ->nullable()
                ->constrained('recurring_payments')
                ->onDelete('cascade')
                ->comment('Referencia al pago recurrente asociado (si aplica)');

            $table->json('reminder_types')->nullable()
                  ->comment('Tipos de recordatorio seleccionados: email, push, sms. Guardado en formato JSON.');

            $table->enum('status', ['active', 'inactive'])
                ->default('active')
                ->comment('Estado del recordatorio: activo o inactivo');

            $table->date('reminder_date')->nullable()
                ->comment('Fecha en la que se enviará el recordatorio');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `reminders` COMMENT ''");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
