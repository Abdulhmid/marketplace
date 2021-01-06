<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransactionHistoryStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tj_transactions_status', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->id();
            $table->timestamps();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by');
            $table->integer('status');
            $table->string('transaction_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tj_transactions_status');
    }
}
