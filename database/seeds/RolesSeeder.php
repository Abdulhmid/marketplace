<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
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
	          'name' => "Admin",
	          'label' => "admin",
	          'description' => "This description for admin role",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ],[
	          'name' => "Produsen",
	          'label' => "produsen",
	          'description' => "This description for produsen role",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ],[
	          'name' => "Seller",
	          'label' => "seller",
	          'description' => "This description seller role",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ],[
	          'name' => "Customers",
	          'label' => "customers",
	          'description' => "This description seller customer",
	          'created_at' => now(),
	          'updated_at' => now(),
	          'status' => 1
	        ]
    	];
	   
	    DB::table('tj_roles')->insert($data);
    }
}
