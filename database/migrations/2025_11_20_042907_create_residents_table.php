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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            
            // Relasi (Foreign Keys)
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('unit_id')->constrained('units');
            
            // Data Sewa
            $table->date('start_date'); 
            $table->date('end_date')->nullable(); 
            $table->enum('status', ['Aktif', 'Nonaktif']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};