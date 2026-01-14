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
            $table->date('date');
            $table->time('time');
            $table->dateTime('datetime')->nullable();
            $table->enum('type', ClassTypesEnum::cases());
            $table->enum('status', ClassStatusEnum::cases());
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
