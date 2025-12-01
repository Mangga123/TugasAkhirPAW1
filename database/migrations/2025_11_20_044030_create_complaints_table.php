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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke residents (Siapa yang lapor)
            $table->foreignId('resident_id')->constrained('residents'); 
            
            $table->string('title', 100); 
            $table->text('description');
            $table->string('image')->nullable(); // Foto bukti (boleh kosong jika tidak ada)
            
            // Status penanganan
            $table->enum('status', ['Pending', 'Proses', 'Selesai']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
