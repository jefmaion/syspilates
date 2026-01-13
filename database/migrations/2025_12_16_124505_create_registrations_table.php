<?php

declare(strict_types = 1);

use App\Enums\RegistrationStatusEnum;
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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('student_id')->nullable()->index();
            $table->foreignId('modality_id')->nullable()->index();
            $table->integer('duration');
            $table->integer('class_per_week');
            $table->date('start');
            $table->date('end');
            $table->decimal('value');
            $table->integer('deadline');
            $table->enum('status', RegistrationStatusEnum::cases());
            $table->datetime('cancel_date')->nullable();
            $table->text('cancel_comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
