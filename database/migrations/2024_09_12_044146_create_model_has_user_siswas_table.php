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
        Schema::create('model_has_user_siswas', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->Integer('user_id');
            $table->bigInteger('nomor_induk');
            $table->integer('is_status_aktif');
            $table->unique(['nomor_induk']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_user_siswas');
    }
};
