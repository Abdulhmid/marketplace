<?php

class AuthHelper {

    public static function sessionData($data) {
    	if (isset(\Auth::user()->role_id)) {
            $role = App\Roles::where('id',\Auth::user()->role_id)->first();
            if ($role->label=="customers") {
                return \Auth::user()->$data;
            }else{
                return "";
            }
        }else{
            return "";
        }
    }

}