<?php

declare(strict_types=1);

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->date('birthdate')->nullable();
            $table->string('nickname', 100)->nullable();
            $table->string('gender', 2)->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('zipcode', 20)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('district', 500)->nullable();
            $table->string('city', 500)->nullable();
            $table->string('complement', 500)->nullable();
            $table->string('number', 500)->nullable();
            $table->string('state', 500)->nullable();
            $table->string('avatar', 500)->nullable();
            $table->boolean('active')->default(true);
            $table->string('theme')->nullable()->default('stone');
            $table->string('theme_mode')->nullable()->default('light');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
