<?php
    namespace App\Helpers;

    use Carbon\Carbon;
    use Illuminate\Support\Facades\Http;

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

        private static function fetch_genre_list(){
            return Http::withToken(config('services.tmdb.token'))
                        ->get(config('services.tmdb.url').'/genre/movie/list')
                        ->json()['genres'];
        }

        public static function genre_convert(){
            $genreList = self::fetch_genre_list();

            return collect($genreList)->mapWithKeys(function ($genre){
                return [$genre['id'] => $genre['name']];
            });
        }
    }
?>