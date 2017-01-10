<?php

class StringUtil {

    public static function randomString($pre = '', $length = 6){
        $enAlphabet = "ABCDEFGHJKMNPQRSTUVWXYZ0123456789";
        //$randomString = $pre;
        $randomString = $pre.substr(str_shuffle($enAlphabet), 0, $length);
        return $randomString;
    }
}