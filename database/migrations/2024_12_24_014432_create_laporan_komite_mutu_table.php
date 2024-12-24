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
        Schema::create('laporan_komite_mutu', function (Blueprint $table) {
            $table->id();
            $table->string('indikatorMutu')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('kip1', 5, 1)->nullable();
            $table->decimal('kip2', 5, 1)->nullable();
            $table->decimal('kip3', 5, 1)->nullable();
            $table->decimal('kip4', 5, 1)->nullable();
            $table->decimal('num', 5, 1)->nullable();
            $table->decimal('denum', 5, 1)->nullable();
            $table->string('bulan')->nullable();
            $table->year('tahun', 5, 1)->nullable();
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
        Schema::dropIfExists('laporan_komite_mutu');
    }
};
