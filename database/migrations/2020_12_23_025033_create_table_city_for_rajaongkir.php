<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCityForRajaongkir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_cities_rajaongkir', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->string('type')->nullable();
            $table->string('province')->nullable();
            $table->string('city_name')->nullable();
            $table->string('postal_code')->nullable();
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
        Schema::dropIfExists('tj_cities_rajaongkir');
    }
}
