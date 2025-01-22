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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Identificador único del usuario');
            $table->string('name')->comment('Nombre del usuario');
            $table->string('email')->unique()->comment('Correo electrónico único del usuario');
            $table->string('mobile', 15)->nullable()->comment('Número de móvil del usuario');
            $table->timestamp('email_verified_at')->nullable()->comment('Fecha de verificación del correo');
            $table->string('password')->comment('Contraseña cifrada del usuario');
            $table->rememberToken()->comment('Token de sesión para recordar al usuario');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `users` COMMENT = 'Tabla que almacena la información de los usuarios registrados en la aplicación.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
