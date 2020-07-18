<?php
namespace common\helpers;

use Yii;

class Utils
{
    public static function getUser($user_type = '')
    { 
        switch ($user_type) {
            case "1":
                return "Super Admin ( user ) ";
                break;
            case "2":
                return "Vendor";
                break;
            case "3":
                return "Client";
                break;
            default:
                return "Client";
        }

    }

    public static function getUserShortName($user_object = null){
        if(!$user_object){ return ''; }
        else{
            $user_name = '';
            if($user_object->first_name!=''){
                ($user_object->first_name!='')?$user_name.=substr( $user_object->first_name,0,1):'';
                ($user_object->last_name!='')?$user_name.=substr( $user_object->last_name,0,1):'';
            }else{
                ($user_object->username!='')?$user_name.=substr( $user_object->username,0,1):'';
            } 
            return strtoupper($user_name);
        } 
        
    }

    public static function getUserName($user_object = null){
        if(!$user_object){ return ''; }
        else{
            $user_name = '';
            if($user_object->first_name!=''){
                 $user_name.= $user_object->first_name.' '.$user_object->last_name;
            }else{
                $user_name.= $user_object->username;
            } 
            return ucfirst(trim($user_name));
        } 
        
    }

    public static function getExperienceName($exp_object = null){
        if(!$exp_object){ return ''; }
        else{ 
             $exp = $exp_object->title; 
            return ucfirst(trim( substr($exp,0,1) ));
        }         
    }

    public static function getUniqueFileName()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public static function get_ipAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
   
    public static function TaostrWidget(){
        return \diecoding\toastr\ToastrFlash::widget([
            'options' => [
                "closeButton" => true,
                "newestOnTop" => true,
                "progressBar" => false, 
                "showDuration" => "300", 
                "hideDuration" => "1000",
                "timeOut" => "5000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "closeEasing" => "linear",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp",
                "closeMethod" => "slideUp"
            ]
        ]);
    }

    public static function getYears(){
        $current_year = date('Y');  
        $range_back = range($current_year-2, $current_year-1);  
        $range = range($current_year, $current_year+4);  
        $years = array_merge($range_back,$range);
        return $years; 
    }

    public static function getYearsMonth(){ 
       $moths = array(
            '1'=>'January',
            '2'=>'February',
            '3'=>'March',
            '4'=>'April',
            '5'=>'May',
            '6'=>'June',
            '7'=>'July ',
            '8'=>'August',
            '9'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December'
        );
        return $moths; 
    }

    public static function getMonthName($code){  
        $code = ltrim($code, "0"); 
        if($code == 0){
            $code = 12;
        }
        
        $moths = array(
             1=>'Jan',
             2=>'Feb',
             3 =>'Mar',
             4=>'Apr',
             5=>'May',
             6=>'June',
             7=>'July ',
             8=>'Aug',
             9=>'Sep',
             10=>'Oct',
             11=>'Nov',
             12=>'Dec'
         );  
         return $moths[$code]; 
    } 

    public static function getDaysList(){ 
        $moths = array(
            1=>'Mon',
            2=>'Tue',
            3 =>'Wed',
            4=>'Thu',
            5=>'Fri',
            6=>'Sat',
            7=>'Sun ',             
        );  
        return $moths; 
    }

    public static function getFirstDayMonth($month,$year){ 
        $dayname = date('D', strtotime("$year-$month-01")); 
        switch ($dayname) {
            case 'Mon':
                return 1;
                break;
            case 'Tue':
                return 2;
                break;
            case 'Wed':
                return 3;
                break;
            case 'Thu':
                return 4;
                break;
            case 'Fri':
                return 5;
                break;
            case 'Sat':
                return 6;
                break;  
            case 'Sun':
                return 7;
                break;  
        } 
    }

    public static function numOfDaysInMonth($month,$year){ 
        $month = (int) ltrim($month, "0");
        $year = (int) $year; 
        if($month == 1){ 
            $month = 12;
            $year = ($year - 1);
        }else{
            $month = ($month - 1);
        } 
        return cal_days_in_month(CAL_GREGORIAN,$month,$year);
    }

    public static function IMG_URL( $base_prefix ){
        $domain = $_SERVER['SERVER_NAME'];
        $url = '/';
        switch ($domain) {
            case "localhost":
                $url = "http://localhost/godoexperience-php";
                break;
            case "127.0.0.1":
                $url = "http://127.0.0.1/godoexperience-php";
                break;
            case "61.246.140.190":
                $url = "http://61.246.140.190/godoexperience";
                break;
            case 'godo.bitcotapps.com':
                $url = "https://godo.bitcotapps.com";
                break;
            default:
                $url = $domain;
        }
        return  $url.'/'.$base_prefix;
    }

    public static function cc($code = 'usd'){
        $code = strtolower($code);
        switch ($code) {
            case "usd":
                return "$";
                break;
            case "inr":
                return "₹";
                break;
            case "eur":
                return "€";
                break;
            case "gbp":
                return "£";
                break;
            default:
                return "$";
        }

    }
    
}