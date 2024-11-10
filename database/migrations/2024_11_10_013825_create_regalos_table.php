<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regalos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID del usuario que hizo el regalo
            $table->string('regalo'); // Descripción o nombre del regalo
            $table->decimal('precio', 8, 2); // Precio del regalo, con 8 dígitos totales y 2 decimales
            $table->timestamps(); // Campos created_at y updated_at

            // Relación con la tabla users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regalos');
    }
};
