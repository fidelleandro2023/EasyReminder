<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        Schema::create('help_faqs', function (Blueprint $table) {
            $table->id()->comment('Identificador único de la pregunta frecuente');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('help_categories')
                ->nullOnDelete()
                ->comment('Categoría a la que pertenece la pregunta frecuente');
            $table->string('question')->comment('Pregunta frecuente formulada por los usuarios');
            $table->text('answer')->comment('Respuesta detallada a la pregunta frecuente');
            $table->string('slug')->unique()->comment('Identificador único para URL amigable');
            $table->integer('order')->default(0)->comment('Orden de aparición en la lista de preguntas frecuentes');
            $table->boolean('is_active')->default(true)->comment('Estado de visibilidad de la pregunta (activa o inactiva)');
            $table->integer('views')->default(0)->comment('Número de veces que se ha visualizado la pregunta');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que creó la pregunta frecuente');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que actualizó la pregunta frecuente');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `help_faqs` COMMENT 'Tabla que almacena las preguntas frecuentes del sistema'");
    }

    public function down() {
        Schema::dropIfExists('help_faqs');
    }
};
