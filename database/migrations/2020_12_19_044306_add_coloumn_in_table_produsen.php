<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnInTableProdusen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tj_produsen', function($table) {
            $table->integer('village_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tj_produsen', function($table) {
            $table->dropColumn('village_id');
            $table->dropColumn('district_id');
        });
    }
}
