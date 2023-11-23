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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id')->nullable()->default(null); // El paciente puede no tener un plan contratado
            $table->text('medical_history')->nullable(); // Historial médico del paciente tal como: enfermedades, alergías u otra información
            $table->date('payment_date')->nullable()->default(null); // Fecha de cuando el cliente hace el pago de la suscripción
            $table->date('expiration_date')->nullable()->default(null); // Fecha en la que expira la suscripción (normalmente dura un año)
        
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
