<?php

class RajaOngkir {

    public static function cities() {
    	$row = App\Menus::where('position',$position)->get();
        return $row;
    }

}