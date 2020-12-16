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

    public static function productType() {
        $row = App\Product_types::select(
                        'id','name','slug','status',
                        'description'
                    )->get();
        return $row;
    }

    public static function productCategories() {
        $row = App\Product_category::select(
                        'id','name','status',
                        'description'
                    )->get();
        return $row;
    }

    public static function produsen() {
        $row = App\Produsen::select(
                        'id','name','email','phone','status',
                        'address'
                    )->get();
        return $row;
    }

    public static function idrFormat($nominal) {
        $row = number_format($nominal, 0, ',', '.');
        return $row;
    }

    public static function ratePromo($rate) {
        $row = $rate+5000;
        return $row;
    }

}