<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_checkouts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->timestamps();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by');
            $table->integer('status')->default(1);
            $table->integer('product_id')->unsigned();
            $table->string('product_name')->nullable();
            $table->integer('varian_id')->unsigned();
            $table->string('varian_name')->nullable();
            $table->text('note_items')->nullable();
            $table->integer('qty')->default(1);
            $table->double('total_price')->default(0);
            $table->string('ip_or_mac_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tj_checkouts');
    }
}
