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
    Schema::create('units', function (Blueprint $table) {
        $table->id(); 
        $table->string('unit_number', 20); // [cite: 22]
        $table->string('tower', 50);       // [cite: 23]
        $table->integer('floor');          // [cite: 25]
        $table->enum('type', ['Studio', '1BR', '2BR']); // [cite: 27]
        $table->enum('status', ['Kosong', 'Terisi', 'Maintenance']); // [cite: 29]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
