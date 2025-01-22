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
        Schema::create('expense_analysis', function (Blueprint $table) {
            $table->id()->comment('Identificador único del análisis de gastos');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('Relación con el usuario');
            $table->foreignId('expense_category_id')->constrained('expense_categories')->onDelete('cascade')->comment('Categoría de gasto asociada');
            $table->decimal('total_spent', 10, 2)->comment('Total gastado en esta categoría');
            $table->date('month')->comment('Mes y año del análisis');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `expense_analysis` COMMENT = 'Tabla que almacena el análisis de gastos mensuales por categoría para cada usuario.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_analysis');
    }
};
