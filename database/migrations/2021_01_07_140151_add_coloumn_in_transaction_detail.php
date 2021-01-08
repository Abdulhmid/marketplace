<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnInTransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tj_transactions_detail', function($table) {
            $table->double('produsen_price')->default(0);
            $table->double('seller_comission')->default(0);
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
            $table->dropColumn('produsen_price');
            $table->dropColumn('seller_comission');
        });
    }
}
