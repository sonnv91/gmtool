<?php

class DateUtil {

    public static function getCurrentTime($format = 'd-m-Y H:i:s'){
        $dateTime = new DateTime();
        return $dateTime->format($format);
    }

    public static function getCurrentUnix(){
        $dateTime = new DateTime();
        return $dateTime->getTimestamp();
    }

    public static function formatTime($unixTime, $format = 'd-m-Y H:i:s'){
        $dateTime = new DateTime();
        $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $dateTime->setTimestamp($unixTime);
        return $dateTime->format($format);
    }

    public static function beginToday(){
        $dateTime = new DateTime();
        $dateTime->setTime(0,0,0);
        return $dateTime->getTimestamp();
    }

    public static function beginOfDay($format, $stringDate){
        $dateTime = new DateTime();
        $dateTime->createFromFormat($format,$stringDate);
        $dateTime->setTime(0,0,0);
        return $dateTime->getTimestamp();
    }

    public static function endToday(){
        $dateTime = new DateTime();
        $dateTime->setTime(23,59,59);
        return $dateTime->getTimestamp();
    }

    public static function endOfDay($format, $stringDate){
        $dateTime = new DateTime();
        $dateTime->createFromFormat($format,$stringDate);
        $dateTime->setTime(23,59,59);
        return $dateTime->getTimestamp();
    }

    public static function beginOfMonth($year = 0, $month = 0){
        $dateTime = new DateTime();
        if($year > 0 && $month > 0){
            $dateTime->setDate($year, $month, 0);
        }
        $dateTime->setTime(0,0,0);
        return $dateTime->getTimestamp();
    }

    public static function addDay($unixTime, $day){
        $dateTime = new DateTime();
        $timeAdded = $day * 86400;
        $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $dateTime->setTimestamp($unixTime + $timeAdded);
        return $dateTime->getTimestamp();
    }

    public static function stringTimeAsiaToUnix($strDate){
        $strDate = str_replace("/","-",$strDate);
        return strtotime($strDate);
    }

    public static function toMongoDate($strDate){
        $strDate = str_replace("/","-",$strDate);
        return new MongoDate(strtotime($strDate));
    }

    public static function toMongoDateFromUnix($second){
        return new MongoDate($second);
    }

}