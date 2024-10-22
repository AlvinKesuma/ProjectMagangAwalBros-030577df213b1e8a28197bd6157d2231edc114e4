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
        Schema::create('waktu_tunggu_rawat_jalan_30min', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->default('Mutu');
            $table->string('month');
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
        Schema::dropIfExists('waktu_tunggu_rawat_jalan');
    }
};
