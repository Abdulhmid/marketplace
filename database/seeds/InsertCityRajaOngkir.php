<?php

use Illuminate\Database\Seeder;

class InsertCityRajaOngkir extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$response = \Http::get('https://api.rajaongkir.com/starter/city', [
		    'key' => '92131b0fe53fd8f8c78e3a289c8f3dcc'
		]);

		$dataCityRajaOngkir=[];
		foreach ($response['rajaongkir']['results'] as $key => $value) {
			$newRow = [
	            'city_id' => $value['city_id'],
	            'province_id' => $value['province_id'],
	            'type' => $value['type'],
	            'province' => $value['province'],
	            'city_name' => $value['city_name'],
	            'postal_code' => $value['postal_code'],
	            'created_at' => now(),
	            'updated_at' => now()
          	];
			array_push($dataCityRajaOngkir, $newRow);
		}

        DB::table('tj_cities_rajaongkir')->insert($dataCityRajaOngkir);
    }
}
