<?php

declare(strict_types=1);

use App\Enums\PaymentMethodEnum;
use App\Enums\TransactionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
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
            $table->foreignId('instructor_id')->nullable()->index();
            $table->date('date');
            $table->string('description');
            $table->decimal('origin_amount');
            $table->decimal('amount')->nullable();
            $table->string('method')->nullable();
            $table->text('comments')->nullable();
            $table->enum('type', TransactionTypeEnum::cases());
            $table->enum('payment_method', PaymentMethodEnum::cases())->nullable();
            $table->datetime('paid_at')->nullable();
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
