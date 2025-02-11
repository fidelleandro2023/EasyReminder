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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('Relación con la tabla de usuarios'); 
            $table->string('message')->comment('Mensaje de la notificación');
            $table->enum('type', ['email', 'sms', 'push'])->comment('Tipo de notificación');
            $table->enum('status', ['sent', 'failed'])->default('sent')->comment('Estado de la notificación');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `notifications` COMMENT ''");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
