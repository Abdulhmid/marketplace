<?php

class GlobalHelper {

    public static function listMenu($position) {
    	$row = App\Menus::where('position',$position)->get();
        return $row;
    }

    public static function config($key) {
    	$row = App\Configurations::where('key',$key)->first()->value;
        return $row;
    }

    public static function sliders() {
    	return App\Sliders::select('id','name','image','description')->get();
    }

}