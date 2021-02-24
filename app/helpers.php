<?php
/**
 * Function that generates a random string
 *
 * @param int $length
 * @return string
 */
function quickRandom(int $length = 10){

    $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);

}


/**
 * Function that returns the date in spanish format
 *
 * @param string $date
 * @return string
 */
function formatDateToEsp($date)
{

    return date("d/m/Y G:i", strtotime($date));

}

/**
 * Function that transform the date to ago date
 *
 * @param string $since
 * @return string
 */
function timeAgo($since){
    $estimate_time = time() - $since;
    if( $estimate_time < 1 ) {
        return 'less than 1 second ago';
    }
    $condition = [
        12 * 30 * 24 * 60 * 60  =>  'año',
        30 * 24 * 60 * 60       =>  'mes',
        24 * 60 * 60            =>  'día',
        60 * 60                 =>  'hora',
        60                      =>  'minuto',
        1                       =>  'segundo'
    ];
    foreach( $condition as $secs => $str ) {
        $d = $estimate_time / $secs;
        if( $d >= 1 ) {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' );
        }
    }
}


