<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        // $this->call(MenusSeeders::class);
        // Users Seeder
        $data = [
          'name' => "MyAdmin Name",
          'username' => "myadmin",
          'email' => "myadmin@email.com",
          'email_verified_at' => now(),
          'password' => bcrypt('123456'),
          'remember_token' => Str::random(10),
          'role_id' => DB::table('tj_roles')->select('id')
                          ->where('label','admin')
                          ->first()->id,
          'status' => 1,
          'image' => NULL,
          'created_at' => now(),
          'updated_at' => now()
        ];
	   
	      DB::table('users')->insert($data);

        // Configurations Seeder
        $dataConfig = [
          [
            'key' => "address_bottom",
            'value' => "<p><strong>JL. Mangkubumi Yogyakarta</strong></p>
              <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
              <p>Phone: +628 32434 5334</p>
              <p>Fax: +628 32434 5333</p>
              ",
            'description' => "This description for addres bottom",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'key' => "fb",
            'value' => "https://www.facebook.com/",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'key' => "ig",
            'value' => "https://www.facebook.com/",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'key' => "tw",
            'value' => "https://www.facebook.com/",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'key' => "google",
            'value' => "https://www.facebook.com/",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_configurations')->insert($dataConfig);

        // Categories
        $dataProductCat = [
          [
            'name' => "Makanan",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],          [
            'name' => "Minuman",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],          [
            'name' => "Kantor",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],          [
            'name' => "Umum",
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_products_category')->insert($dataProductCat);

        // Sliders
        $dataSliders = [
          [
            'name' => "Free Ongkir (New)",
            'image' => NULL,
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "Bebas Pilih",
            'image' => NULL,
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "New Free Ongkir",
            'image' => NULL,
            'description' => "This description for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_sliders')->insert($dataSliders);

        // Produsen
        $dataProdusen = [
          [
            'name' => "PT. Angkasa Indoraya",
            'phone' => '62856387777',
            'email' => 'email@email.com',
            'address' => "This address for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "CV Bumi Sejahtera",
            'phone' => '62856381111',
            'email' => 'emailbumi@email.com',
            'address' => "This address for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_produsen')->insert($dataProdusen);

        // Payment
        $dataPayment = [
          [
            'name' => "Cash",
            'label' => 'cash',
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "Transfer Bank",
            'label' => 'transfer-bank',
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_payments')->insert($dataPayment);

        // Payment
        $dataProductType = [
          [
            'name' => "Produksi",
            'slug' => "type-produksi",
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "Ready Stock",
            'slug' => "type-ready-stok",
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "Pesanan",
            'slug' => "type-pesanan",
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_products_types')->insert($dataProductType);

        // Banner
        $dataBanner = [
          [
            'name' => "Banner 1",
            'image' => "public/imagesBanners/default-1.png",
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ],[
            'name' => "Banner 2",
            'image' => "public/imagesBanners/default-2.png",
            'description' => "This data for data",
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 0,
            'created_by' => 0,
            'status' => 1
          ]
        ];

        DB::table('tj_banners')->insert($dataBanner);

        // Menu
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

        // $this->call(UserSeeder::class);
    }
}
