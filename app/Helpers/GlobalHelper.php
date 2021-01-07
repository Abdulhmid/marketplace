<?php

class GlobalHelper {

    public static function dateFormat($date) {
        return date('d/F/Y H:i:s', strtotime($date));
    }

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

        return $row;
    }

    public static function payments() {
        $row = App\Payments::select('*')->get();
        return $row;
    }

    public static function generateCode(){
        do {
            $str = strtoupper(Str::random(7));

            $checkUnique = App\Transactions::where('transaction_code', $str)->count();

        } while ($checkUnique > 0);

        return strtoupper($str);
    }

    public static function productName($id) {
        $row = App\Products::select('id','name')->where('id',$id)->first()->name;
        return $row;
    }

    public static function paymentName($id) {
        $row = App\Payments::select('id','name')->where('id',$id)->first()->name;
        return $row;
    }

    public static function session(){
        $role = App\Roles::where('id',\Auth::user()->role_id)->first();
        return $role->label;
    }

    public static function transactionCount($status){
        $data = App\Transactions::whereIn('status',$status)->select('id','status')->count();
        return $data;
    }

    public static function ekspedisi() {
        $row = App\Ekspedisi::select('id','name','label')->get();
        return $row;
    }

    public static function transUnique() {
        $digits = 3;
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

    public static function wordingStatusTransaksi($status) {
        if ($status == '0') {
            $statusDisplay='Di Tolak';
        }elseif ($status == '1') {
            $statusDisplay='Menunggu Pembayaran';
        }elseif ($status == '2') {
            $statusDisplay='Terbayar';
        }elseif ($status == '3') {
            $statusDisplay='Pembayaran Dikonfirmasi';
        }elseif ($status == '4') {
            $statusDisplay='Proses Pembuatan';
        }elseif ($status == '5') {
            $statusDisplay='Proses Pengiriman';
        }elseif ($status == '6') {
            $statusDisplay='Barang Diterima';
        }elseif ($status == '7') {
            $statusDisplay='Dibatalkan';
        }elseif ($status == '8') {
            $statusDisplay='Permohonan Komplaint';
        }elseif ($status == '9') {
            $statusDisplay='Komplain Diterima';
        }elseif ($status == '10') {
            $statusDisplay='Komplain Ditolak';
        }
        return $statusDisplay;
    }

    public static function labelRole($label){
        return App\Roles::where('label',$label)->first()->id;
    }

    public static function saldo(){
        $userId = \Auth::user()->id;
        $tempSaldo =  App\Mutation::where('user_id',$userId)
                ->orderBy('created_at','desc')
                ->first();
        if (isset($tempSaldo)) {
            return $tempSaldo->saldo;
        }else{
            return 0;
        }
    }

    public static function listProduct(){
        return App\Products::select('id','name','total_price','produsen_id','city_id')->get();
    }

    public static function productTop(){
        return App\Products::with(['category','variant'])->paginate(5);
    }

    public static function imageShow($image){
        if (isset($image)) {
            return $image;
        }else{
            return "";
        }
    }

    public static function seller($productId){
        $data = App\Product_seller::with(['seller'])->where('product_id',$productId)->get();
        return $data;
    }

    public static function nameSeller($sellerID){
        return App\User::find($sellerID)->name;
    }

}