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
        Schema::create('menus', function (Blueprint $table) {
            $table->id()->comment('Identificador único del menú');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Identificador del menú padre, permite definir submenús');
            $table->string('name')->comment('Nombre del menú');
            $table->string('url')->comment('Ruta o URL asociada al menú');
            $table->string('icon')->nullable()->comment('Clase de ícono asociada al menú (opcional)');
            $table->json('roles')->nullable()->comment('Lista de roles con acceso al menú');
            $table->json('permissions')->nullable()->comment('Lista de permisos requeridos para ver el menú');
            $table->integer('order')->default(0)->comment('Orden del menú, determina la posición al mostrarlo');
            $table->timestamps(); 
            // Relación recursiva
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade')->comment('Relación recursiva para submenús');
        });
 
        DB::statement("ALTER TABLE `menus` COMMENT 'Tabla que almacena los elementos del menú, incluyendo roles, permisos y relaciones jerárquicas'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
