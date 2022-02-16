<?php
    namespace App\Helpers;

    use Carbon\Carbon;

    class General 
    {
        public static function b_date($date){
            return Carbon::parse($date)->format('M d, Y');
        }

        public static function release_date($date){
            return Carbon::parse($date)->format('Y');
        }

        public static function convert_runtime($time){
            $hour = floor($time / 60);

            $minute = $time % 60;

            return $hour . ' hour(s) ' . $minute . ' minute(s)';
        }
    }
?>