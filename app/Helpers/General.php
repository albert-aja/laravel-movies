<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class General 
{
    public static function callAPI($url){
        return Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.url').$url)
                    ->json();
    }

    public static function b_date($date){
        return Carbon::parse($date)->format('M d, Y');
    }

    public static function get_year($date){
        return Carbon::parse($date)->format('Y');
    }

    public static function get_age($date){
        return Carbon::parse($date)->age;
    }

    public static function convert_runtime($time){
        $hour = floor($time / 60);

        $minute = $time % 60;

        return $hour . ' hour(s) ' . $minute . ' minute(s)';
    }
}
?>