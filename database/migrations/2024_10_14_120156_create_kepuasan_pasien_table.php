<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepuasan_pasien', function (Blueprint $table) {
           $table->id();
            $table->string('unit')->default('CRO');
            $table->string('month');
            $table->decimal('tahun_2023', 4, 1)->default(0.0); 
            $table->decimal('tahun_2024', 4, 1)->default(0.0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepuasan_pasien');
    }
};
