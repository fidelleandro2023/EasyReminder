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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id()->comment('Identificador único del recordatorio');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Referencia al usuario que creó el recordatorio');
            $table->foreignId('payment_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Referencia al pago asociado que se está recordando');
            $table->enum('reminder_type', ['email', 'push', 'sms'])
                ->comment('Tipo de recordatorio: correo electrónico, notificación push o SMS');
            $table->enum('status', ['active', 'inactive'])
                ->default('active')
                ->comment('Estado del recordatorio: activo o inactivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
