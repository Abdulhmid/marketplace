<?php

use Illuminate\Database\Seeder;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
	        [
	          'name' => "JNE",
	          'label' => "jne",
	          'description' => "This description for jne",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ],[
	          'name' => "POS Indonesia",
	          'label' => "pos",
	          'description' => "This description for pos indonesia",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ],[
	          'name' => "TIKI",
	          'label' => "tiki",
	          'description' => "This description for tiki",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ]
    	];
	   
	    DB::table('tj_ekspedisi')->insert($data);
    }
}
