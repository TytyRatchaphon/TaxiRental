<?php

use App\Models\Student;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->date('event_date');
            $table->string('event_thumbnail')->nullable();
            $table->string('event_image')->nullable();
            $table->string('event_location');
            $table->text('event_description')->nullable();
            $table->decimal('event_expense_amount', 10, 2);
            $table->integer('event_applicants_limit');
            $table->integer('event_staffs_limit');
            $table->string('event_approval_status')->default('pending');
            $table->date('event_application_deadline');
            $table->integer('event_applicants')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
