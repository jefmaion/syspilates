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
        Schema::create('class_makeups', function (Blueprint $table) {
            $table->id();
            // Relacionamentos principais
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('registration_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Aula que originou o crédito
            $table->foreignId('origin_class_id')
                ->nullable()
                ->constrained('classes')
                ->nullOnDelete();

            // Motivo do crédito
            $table->string('reason', 100);
            // exemplos: absence, instructor_cancel, other

            // Validade do crédito
            $table->timestamp('expires_at');

            // Consumo do crédito
            $table->timestamp('used_at')->nullable();

            $table->foreignId('used_class_id')
                ->nullable()
                ->constrained('classes')
                ->nullOnDelete();

            // Status do crédito
            $table->string('status', 20)->default('active');
            // active | used | expired

            $table->timestamps();

            // Índices úteis
            $table->index(['student_id', 'status']);
            $table->index(['expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_makeups');
    }
};
