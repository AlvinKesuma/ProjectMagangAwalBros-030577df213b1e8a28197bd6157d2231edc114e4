<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenundaanOperasiElectif30MinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Penundaan_Operasi_Electif_30Min', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->decimal('num', 5, 1);
            $table->decimal('denum', 5, 1);
            $table->string('month');
            $table->decimal('tahun_2023', 5, 1);
            $table->decimal('tahun_2024', 5, 1);
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
        Schema::dropIfExists('Penundaan_Operasi_Electif_30Min');
    }
}
