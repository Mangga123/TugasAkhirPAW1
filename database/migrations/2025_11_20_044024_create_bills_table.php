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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke residents (Siapa yang ditagih)
            $table->foreignId('resident_id')->constrained('residents'); 
            
            $table->string('month', 20); // Contoh: "Oktober 2025"
            $table->double('amount');    // Jumlah tagihan
            
            // Status pembayaran
            $table->enum('status', ['Belum Dibayar', 'Menunggu Konfirmasi', 'Lunas']);
            
            $table->date('due_date'); // Jatuh tempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
