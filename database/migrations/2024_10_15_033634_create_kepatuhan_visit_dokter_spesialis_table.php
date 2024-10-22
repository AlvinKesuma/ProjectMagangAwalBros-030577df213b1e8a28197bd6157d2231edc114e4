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
        Schema::create('kepatuhan_visit_dokter_spesialis', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->default('SOD');
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
        Schema::dropIfExists('kepatuhan_visit_dokter_spesialis');
    }
};
