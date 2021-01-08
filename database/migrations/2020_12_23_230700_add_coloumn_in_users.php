<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('city_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->string('phone')->nullable();
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
        Schema::table('users', function($table) {
            $table->dropColumn('city_id');
            $table->dropColumn('province_id');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
}
