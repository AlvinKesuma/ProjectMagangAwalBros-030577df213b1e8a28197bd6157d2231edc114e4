<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeOutPoliGigiTable extends Migration
{
    public function up()
    {
        Schema::create('timeout_poligigi', function (Blueprint $table) {
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

    public function down()
    {
        Schema::dropIfExists('timeout_poligigi');
    }
}
