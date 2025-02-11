<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        Schema::create('help_guides', function (Blueprint $table) {
            $table->id()->comment('Identificador único de la guía de ayuda');
            $table->string('title')->comment('Título de la guía de ayuda');
            $table->text('content')->comment('Contenido detallado de la guía');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('help_categories')
                ->nullOnDelete()
                ->comment('Categoría a la que pertenece la guía');
            $table->string('slug')->unique()->comment('Identificador único para URL amigable');
            $table->integer('order')->default(0)->comment('Orden de aparición en la lista de guías');
            $table->boolean('is_active')->default(true)->comment('Estado de visibilidad de la guía (activa o inactiva)');
            $table->integer('views')->default(0)->comment('Número de veces que se ha visualizado la guía');
            $table->string('video_url')->nullable()->comment('URL de un video explicativo opcional');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que creó la guía de ayuda');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que actualizó la guía de ayuda');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `help_guides` COMMENT 'Tabla que almacena las guías de ayuda del sistema'");
    }

    public function down() {
        Schema::dropIfExists('help_guides');
    }
};
