<?php
require_once 'header.php';

$result = queryMySQL("SELECT startzeit FROM zeiten WHERE name='testneu24444'");
$result -> data_seek(0);
$hash = $result -> fetch_assoc()[startzeit];

$result = queryMySQL("SELECT endzeit FROM zeiten WHERE name='testneu24444'");
$result -> data_seek(0);
$hash2 = $result -> fetch_assoc()[endzeit];

$zeit=$hash2-$hash;
echo $hash, "</br>";
echo $hash2, "</br>";
echo $zeit, "</br>";

function get_time_difference($start_time_o, $end_time_o){
    $start_time = explode(":", $start_time_o);
    $end_time = explode(":", $end_time_o);

    $start_time_stamp = mktime($start_time[0], $start_time[1], 0, 0, 0, 0);
    $end_time_stamp = mktime($end_time[0], $end_time[1], 0, 0, 0, 0);

    $time_difference = $end_time_stamp - $start_time_stamp;

    return gmdate("H:i", $time_difference);
}

$zeit2 = get_time_difference($hash, $hash2);

echo $zeit2;
 ?>
