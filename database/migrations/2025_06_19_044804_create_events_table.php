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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('cover')->nullable();
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->string('location');
            $table->integer('max_participants')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('admin_name')->nullable();
            $table->text('result_description')->nullable();
            $table->decimal('saved_waste_amount', 10, 2)->nullable();
            $table->integer('actual_participants')->nullable();
            $table->datetime('result_submitted_at')->nullable();
            $table->string('result_submitted_by_name')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
