<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->timestamps();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by');
            $table->integer('status')->default(1);
            $table->string('name');
            $table->string('short_desc');
            $table->text('description');
            $table->double('produsen_price');
            $table->double('commission_price');
            $table->double('total_price');
            $table->string('image')->nullable();
            $table->integer('product_category_id')->unsigned();
            $table->integer('product_type_id')->unsigned();
            $table->integer('produsen_id')->unsigned();

            // $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tj_products');
    }
}
