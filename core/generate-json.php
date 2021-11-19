<?php
include '../core/conexion.php';

//$sql = 'SELECT * FROM banners_zones NATURAL JOIN banners';
$sql = "SELECT * FROM events";
$sent = $pdo->prepare($sql);
$sent->execute();
$res = $sent->fetchAll();

$arrayV;//

foreach ($res as $key) {
    $arrayV[] = array(
        "title" => $key['Title'],
        "start" => $key['DateStar'],
        "end"   => $key['DateEnd'],
        "description" => $key['Description'],
        "hourstar" => $key['HourStar'],
        "hourend" => $key['HourEnd'],
        "color" => $key['Color'],
        "textColor" => '#ffffff'
    );
}
$resEncodeA  = json_encode($arrayV);

//echo '<pre>';
echo $resEncodeA;
//echo '</pre>';