<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnBankOnRedeem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tj_withdraw_income', function($table) {
            $table->string('bank_name')->nullable();
            $table->string('rekening')->nullable();
            $table->string('account_behalf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tj_withdraw_income', function($table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('rekening');
            $table->dropColumn('account_behalf');
        });
    }
}
