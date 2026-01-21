<?php

declare(strict_types = 1);

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('registration_id')->nullable()->index();
            $table->foreignId('instructor_id')->nullable()->index();
            $table->foreignId('student_id')->nullable()->index();
            $table->foreignId('modality_id')->nullable()->index();
            $table->foreignId('registration_schedule_id')->nullable()->index();
            $table->dateTime('scheduled_datetime')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->enum('type', ClassTypesEnum::cases());
            $table->enum('status', ClassStatusEnum::cases());
            $table->boolean('is_makeup')->default(false);
            $table->integer('original_class_id')->nullable();
            $table->integer('makeup_class_id')->nullable();
            $table->integer('makeup_credit_id')->nullable();
            $table->text('evolution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
