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
        Schema::create('soal_kuis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kuiss_id')->constrained('kuiss')->onDelete('cascade');
        $table->text('pertanyaan');
        $table->string('opsi_a');
        $table->string('opsi_b');
        $table->string('opsi_c');
        $table->string('opsi_d');
        $table->string('jawaban_benar'); 
        $table->timestamps();
    });

        Schema::create('hasil_kuis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kuiss_id')->constrained('kuiss')->onDelete('cascade');
        $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
        $table->integer('nilai'); 
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kuis');
        Schema::dropIfExists('soal_kuis');
    }
};
