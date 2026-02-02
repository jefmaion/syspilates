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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('registration_id')->nullable()->index();
            $table->foreignId('student_id')->nullable()->index();
            $table->date('date');
            $table->date('paid_at')->nullable();
            $table->string('description');
            $table->decimal('amount');
            $table->string('method')->nullable();
            $table->string('status');
            $table->string('reference_type')->nullable();
            $table->integer('reference_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
