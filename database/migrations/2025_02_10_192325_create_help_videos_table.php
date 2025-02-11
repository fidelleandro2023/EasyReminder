<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        Schema::create('help_videos', function (Blueprint $table) {
            $table->id()->comment('Identificador único del video');
            $table->string('title')->comment('Título del video de ayuda');
            $table->text('url')->comment('URL del video (YouTube, Vimeo, etc.)');
            $table->text('description')->nullable()->comment('Descripción del contenido del video');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('help_categories')
                ->nullOnDelete()
                ->comment('Categoría a la que pertenece el video');
            $table->boolean('is_active')->default(true)->comment('Estado del video (activo o inactivo)');
            $table->integer('views')->default(0)->comment('Cantidad de veces que se ha visto el video');
            $table->integer('order')->default(0)->comment('Orden de aparición en la lista de videos');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que subió el video');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->comment('Último usuario que modificó el video');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `help_videos` COMMENT 'Tabla que almacena videos de ayuda para el sistema'");
    }

    public function down() {
        Schema::dropIfExists('help_videos');
    }
};
