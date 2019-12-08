<?php


namespace App;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Helper {
    public static function getUserToken() {
        $token = Cookie::get("token");

        if ($token) return $token;

        $token = Str::random(32);

        Cookie::queue("token", $token, 60 * 24 * 30);

        return $token;
    }
}
