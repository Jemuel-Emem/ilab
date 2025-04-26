<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('is_admin')->default(0);
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();

            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->float('height')->nullable(); // in cm or specify in form
            $table->float('weight')->nullable(); // in kg or specify in form
            $table->string('blood_pressure')->nullable(); // BP like "120/80"
            $table->float('temperature')->nullable(); // Temperature in Celsius

            $table->text('lab_result')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
