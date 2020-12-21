<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnOnTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tj_transactions', function($table) {
            $table->string('buyer_email')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->string('buyer_city')->nullable();
            $table->string('buyer_districts')->nullable();
            $table->string('buyer_villages')->nullable();
            $table->text('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tj_transactions', function($table) {
            $table->dropColumn('buyer_phone');
            $table->dropColumn('buyer_phone');
            $table->dropColumn('buyer_city');
            $table->dropColumn('buyer_districts');
            $table->dropColumn('buyer_villages');
            $table->dropColumn('address');
        });
    }
}
