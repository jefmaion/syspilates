<?php

declare(strict_types = 1);

use App\Enums\ClassStatusEnum;
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
        Schema::create('experimental_classes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->foreignId('modality_id')->nullable()->index();
            $table->foreignId('instructor_id')->nullable()->index();
            $table->dateTime('datetime')->nullable();
            $table->float('value')->nullable();
            $table->enum('status', ClassStatusEnum::cases());
            $table->text('comments')->nullable();
            $table->text('instructor_comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experimental_classes');
    }
};
