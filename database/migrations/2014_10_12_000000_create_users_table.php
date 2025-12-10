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
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->string('password');

            // Data user : 
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->json('education_json')->nullable();
            $table->json('certifications_json')->nullable();
            $table->json('skills_json')->nullable();
            $table->json('languages_json')->nullable();
            $table->json('experiences_json')->nullable();
            $table->string('file_cv')->nullable();

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
