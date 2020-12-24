<?php

class RajaOngkir {

    public static function cities() {
    	$row = App\CitiesRajaOngkir::select('*')->get();
        return $row;
    }

    public static function cekOngkir($courier,$origin,$destination,$weight) {
        $request = \Http::withHeaders([
            'key' => '92131b0fe53fd8f8c78e3a289c8f3dcc'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $request['rajaongkir']['results'][0]['costs'];
    }    

}