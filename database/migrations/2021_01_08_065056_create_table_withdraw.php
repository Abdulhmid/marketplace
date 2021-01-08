<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWithdraw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_withdraw_income', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->timestamps();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by');
            $table->double('nominal')->default(0);
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->integer('user_id')->nullable();
            $table->integer('admin_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tj_withdraw_income');
    }
}
