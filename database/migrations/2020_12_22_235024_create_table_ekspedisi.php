<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEkspedisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_ekspedisi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('status')->default(1);
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tj_ekspedisi');
    }
}
