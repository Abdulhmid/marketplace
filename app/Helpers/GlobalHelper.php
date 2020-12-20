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

    public static function checkout($ip, $type) {
        if ($type='count') {
            return App\Checkouts::select(
                        'id','ip_or_mac_address','total_price','qty','note_items',
                        'varian_id','varian_name','product_id','product_name','status'
                    )->where('ip_or_mac_address',$ip)->count();
        }else{
            return App\Checkouts::select(
                        'id','ip_or_mac_address','total_price','qty','note_items',
                        'varian_id','varian_name','product_id','product_name','status'
                    )->where('ip_or_mac_address',$ip)->get();
        }
    }

    public static function province() {
        $row = App\Provinces::select('*')->get();
        return $row;
    }

    public static function cities($province) {
        $row = App\Cities::select('*')->where('province_id',$province)->get();
        return $row;
    }

    public static function districs($city) {
        $row = App\Districts::select('*')->where('city_id',$city)->get();
        return $row;
    }

    public static function villages($district) {
        $row = App\Villages::select('*')->where('district_id',$district)->get();
        // $row = App\Villages::select('*')->where('district_id',$district)->get();
        return $row;
    }

}