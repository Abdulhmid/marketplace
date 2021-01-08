<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnSellerInTransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tj_transactions_detail', function($table) {
            $table->integer('seller_id')->nullable();
            $table->integer('produsen_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tj_transactions_detail', function($table) {
            $table->dropColumn('seller_id');
            $table->dropColumn('produsen_id');
        });
    }
}
