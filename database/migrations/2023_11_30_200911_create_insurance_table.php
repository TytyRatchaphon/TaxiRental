<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Taxi;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insurance', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Taxi::class, 'car_license');
            $table->string('insurance_type');
            $table->string('company');
            $table->string('start_date');
            $table->string('expired_date');
            $table->string('I_phonenumber');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance');
    }
};
