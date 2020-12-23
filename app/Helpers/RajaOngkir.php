<?php

class RajaOngkir {

    public static function cities() {
    	$row = App\CitiesRajaOngkir::select('*')->get();
        return $row;
    }

}