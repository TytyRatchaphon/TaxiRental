<?php

use App\Models\Payment;
use App\Models\Taxi;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->foreignIdFor(Taxi::class)->constrained('taxis');
            $table->enum('B_status',['PENDING','ON TRIP','END TRIP','CANCLE'])->default('PENDING');
            $table->string('B_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
