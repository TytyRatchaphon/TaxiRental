<?php

use App\Models\Booking;
use App\Models\Insurance;
use App\Models\Student;
use App\Models\User;
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
        Schema::create('taxis', function (Blueprint $table) {
            $table->id();
            $table->string('car_license')->unique();
            $table->string('registration_no')->unique();
            $table->string('car_color');
            $table->string('car_model');
            $table->string('car_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxis');
    }
};