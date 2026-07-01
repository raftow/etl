<?php

class DataTransformationService {
    /**
     * @param string $string
     * @return string
     */
    public static function trim($string) {
        return trim($string);
    }

    /**
     * @param string $string
     * @return bool
     */
    public static function isTrimmedString($string) {
        return (trim($string)==$string);
    }

    /**
     * @param string $mobile
     */
    public static function formatMobile($mobile) {
        return AfwFormatHelper::formatMobile($mobile);
    }

    /**
     * @param string $mobile
     * @return bool
     */
    public static function isCorrectMobileFormat($mobile) {
        return AfwFormatHelper::isCorrectMobileNum($mobile);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function decodeIDNType($string) {
        list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($string);
        return $idn_type_id;
    }

    /**
     * @param string $string
     * @return bool
     */
    public static function isCorrectIDNType($string) {
        $idn_type = intval($string);
        if($idn_type==1) return true; // هوية وطنية - بطاقة أحوال
        if($idn_type==2) return true; // هوية مقيم - إقامة
        if($idn_type==99) return true; // أنواع هويات أخرى مسموح بها

        return false;
    }


    /**
     * @param string $string
     * @return string
     */
    public static function toGregorianConvert($string) {
        $gdate = AfwDateHelper::repareGorbojGregDate($string);
        return $gdate;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function toHijriConvert($string) {
        $hijri_separator = AfwSession::config("etl-hijri-separator", "/");
        $hdate = AfwDateHelper::repareGorbojHijriDate($string);
        $hdate2 = AfwDateHelper::inputFormatHijriDate($hdate, $hijri_separator);
        return $hdate2;
    }


    /**
     * @param string $string
     * @return string
     */
    public static function extractLastnameFromFullName($string) {
        list($first_name, $father_name, $last_name) = AfwStringHelper::arabic_full_name_explode($string);

        return $last_name;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function extractFathernameFromFullName($string) {
        list($first_name, $father_name, $last_name) = AfwStringHelper::arabic_full_name_explode($string);

        return $father_name;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function extractFirstnameFromFullName($string) {
        list($first_name, $father_name, $last_name) = AfwStringHelper::arabic_full_name_explode($string);

        return $first_name;
    }

    


    

    
    

    

    
}