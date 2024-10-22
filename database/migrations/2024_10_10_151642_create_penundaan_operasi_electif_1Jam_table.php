<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenundaanOperasiElectif1JamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Penundaan_Operasi_Electif_1Jam', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->default('Kamar Bedah');
            $table->decimal('num', 4, 1)->default(0.0); 
            $table->decimal('denum', 4, 1)->default(0.0); 
            $table->string('month');
            $table->year('year');
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
        Schema::dropIfExists('Penundaan_Operasi_Electif_1Jam');
    }
}
