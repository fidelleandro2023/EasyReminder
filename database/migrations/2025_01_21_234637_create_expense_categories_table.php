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
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id()->comment('Identificador único de la categoría de gasto');
            $table->string('name')->comment('Nombre de la categoría, por ejemplo: agua, luz, entretenimiento');
            $table->text('description')->nullable()->comment('Descripción opcional de la categoría');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `expense_categories` COMMENT = 'Tabla que almacena las categorías de gastos para análisis y reportes.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_categories');
    }
};
