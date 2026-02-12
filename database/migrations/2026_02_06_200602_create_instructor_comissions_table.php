<?php

use App\Enums\ComissionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructor_comissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('class_id');
            $table->foreignId('instructor_id');
            $table->foreignId('transaction_id')->nullable();
            $table->datetime('datetime');
            $table->enum('comission_type', ComissionTypeEnum::cases());
            $table->decimal('comission_value', 8, 2);
            $table->decimal('class_value', 8, 2);
            $table->decimal('value', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_comissions');
    }
};
