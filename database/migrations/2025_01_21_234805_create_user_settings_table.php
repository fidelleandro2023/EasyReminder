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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id()->comment('Identificador único de la configuración');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('Relación con el usuario');
            $table->enum('language', ['en', 'es'])->default('en')->comment('Idioma preferido por el usuario');
            $table->boolean('notifications_enabled')->default(true)->comment('Indica si las notificaciones están activadas');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_settings` COMMENT = 'Tabla que almacena las configuraciones personalizadas de los usuarios.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
