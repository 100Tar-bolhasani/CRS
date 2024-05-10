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
        Schema::create('guest_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->onDelete('cascade')->index()->constrained();
            $table->foreignId('country_id')->index()->constrained();
            $table->date('birthday')->nullable();
            $table->string('gender', 10 )->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_profiles');
    }
};
