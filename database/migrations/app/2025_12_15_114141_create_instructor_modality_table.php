<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructor_modality', function (Blueprint $table) {
            $table->id();

            $table->foreignId('instructor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('modality_id')->constrained()->cascadeOnDelete();

            $table->unique(['instructor_id', 'modality_id']);

            // Campos extras da pivot
            $table->enum('commission_type', ['percent', 'fixed']);
            $table->decimal('commission_value', 8, 2);
            $table->boolean('calculate_on_justified_absence')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_modality');
    }
};
