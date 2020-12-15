<?php

use Illuminate\Database\Seeder;

class MenusSeeders extends Seeder
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
	          'name' => "Home",
	          'url' => "/",
	          'sort' => 1,
	          'position' => 'top',
	          'description' => "This description for home",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'updated_by' => 0,
	          'created_by' => 0,
	          'status' => 1
	        ],[
	          'name' => "Products",
	          'url' => "/products",
	          'sort' => 2,
	          'position' => 'top',
	          'description' => "This description for products",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'updated_by' => 0,
	          'created_by' => 0,
	          'status' => 1
	        ],[
	          'name' => "Contact",
	          'url' => "/contact",
	          'sort' => 3,
	          'position' => 'top',
	          'description' => "This description for contact",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'updated_by' => 0,
	          'created_by' => 0,
	          'status' => 1
	        ],[
	          'name' => "Help",
	          'url' => "/",
	          'sort' => 3,
	          'position' => 'bottom',
	          'description' => "This description for help",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'updated_by' => 0,
	          'created_by' => 0,
	          'status' => 1
	        ],[
	          'name' => "Contact",
	          'url' => "/",
	          'sort' => 3,
	          'position' => 'bottom',
	          'description' => "This description for contact",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'updated_by' => 0,
	          'created_by' => 0,
	          'status' => 1
	        ]
    	];
	   
	    DB::table('tj_menus')->insert($data);
    }
}
