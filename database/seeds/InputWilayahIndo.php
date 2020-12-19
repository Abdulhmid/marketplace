<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InputWilayahIndo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Province
        $now = Carbon::now();
        $file = public_path().'/resources/csv/provinces.csv';
        $header = ['id', 'name', 'lat', 'long'];

        //  CsvToArray
        $delimiter = ',';
        if (!file_exists($file) || !is_readable($file)) {
            return false;
        }

        $data = [];
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }


        $data = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
            unset($arr['lat'], $arr['long']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        DB::table('tj_provinces')->insert($data);

        // City
        $now = Carbon::now();
        $file = public_path().'/resources/resources/csv/cities.csv';
        $header = ['id', 'province_id', 'name', 'lat', 'long'];

        //  CsvToArray
        $delimiter = ',';
        if (!file_exists($file) || !is_readable($file)) {
            return false;
        }

        $data = [];
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        $data = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
            unset($arr['lat'], $arr['long']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table('tj_cities')->insert($chunk->toArray());
        }

        // District
        $now = Carbon::now();
        $file = public_path().'/resources/csv/districts.csv';
        $header = ['id', 'city_id', 'name', 'lat', 'long'];
       
        //  CsvToArray
        $delimiter = ',';
        if (!file_exists($file) || !is_readable($file)) {
            return false;
        }

        $data = [];
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        $data = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
            unset($arr['lat'], $arr['long']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table('tj_districts')->insert($chunk->toArray());
        }

        // Village
        $now = Carbon::now();
        $resourceFiles = \File::allFiles(public_path().'/resources/resources/csv/villages');
        foreach ($resourceFiles as $file) {
            $header = ['id', 'district_id', 'name', 'lat', 'long'];

	        //  CsvToArray
	        $delimiter = ',';
	        if (!file_exists($file->getRealPath()) || !is_readable($file->getRealPath())) {
	            return false;
	        }

	        $data = [];
	        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
	            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
	                $data[] = array_combine($header, $row);
	            }
	            fclose($handle);
	        }

            $data = array_map(function ($arr) use ($now) {
                $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
                unset($arr['lat'], $arr['long']);

                return $arr + ['created_at' => $now, 'updated_at' => $now];
            }, $data);

            $collection = collect($data);
            foreach ($collection->chunk(50) as $chunk) {
                DB::table('tj_villages')->insert($chunk->toArray());
            }
        }
    }

    public function csv_to_array($filename, $header)
    {
        $delimiter = ',';
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
