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
        Schema::create('registration_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('registration_id')->nullable()->index();
            $table->integer('duration');
            $table->integer('class_per_week');
            $table->date('start');
            $table->date('end');
            $table->decimal('value');
            $table->integer('deadline');
            $table->enum('status', ['sheduled', 'active', 'finished', 'canceled']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_plans');
    }
};
