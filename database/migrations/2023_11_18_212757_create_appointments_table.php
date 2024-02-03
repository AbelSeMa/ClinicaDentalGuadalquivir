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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('worker_id');
            $table->date('date');
            $table->time('hour');
            $table->text('notes')->nullable();
            $table->enum('status', ['Presentado', 'No presentado', 'Pendiente'])->default('Pendiente');
            $table->timestamps();
        
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('worker_id')->references('id')->on('workers');

            $table->unique(['date', 'hour', 'worker_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
