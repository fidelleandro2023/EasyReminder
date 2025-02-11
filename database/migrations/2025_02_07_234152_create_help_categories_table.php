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
        Schema::create('help_categories', function (Blueprint $table) {
            $table->id()->comment('Identificador único de la categoría');
            $table->string('name')->unique()->comment('Nombre único de la categoría de ayuda');
            $table->string('slug')->unique()->comment('Identificador único para URL amigable');
            $table->text('description')->nullable()->comment('Descripción opcional de la categoría');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Estado de la categoría: activa o inactiva');
            $table->string('icon')->nullable()->comment('Ruta o nombre del icono asociado a la categoría');
            $table->integer('order')->default(0)->comment('Orden de aparición de la categoría');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que creó la categoría');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que actualizó la categoría');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `help_categories` COMMENT 'Tabla que almacena las categorías de ayuda en el sistema'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_categories');
    }
};
