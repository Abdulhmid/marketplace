<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnEkpedisiTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tj_transactions', function($table) {
            $table->string('courier')->nullable();
            $table->string('courier_service')->nullable();
            $table->double('shipping_fee')->default(0);
            $table->double('unique_fee')->default(0);
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
            $table->dropColumn('courier');
            $table->dropColumn('courier_service');
            $table->dropColumn('shipping_fee');
            $table->dropColumn('unique_fee');
        });
    }
}
