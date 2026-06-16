<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->longText('konten_materi');
            $table->string('file_lampiran');
            $table->string('link_video');
            $table->timestamps(); 
        });
    }
    public function down() { Schema::dropIfExists('materis'); }
};
