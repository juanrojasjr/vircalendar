<?php
$config = include 'config.php';

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

$sql = "SELECT * FROM events";
$sent = $connection->prepare($sql);
$sent->execute();
$res = $sent->fetchAll();

$arrayV;

foreach ($res as $key) {
    $arrayV[] = array(
        "title" => $key['name'],
        "start" => $key['date_start'],
        "end"   => $key['date_end'],
        "desc" => $key['desc'],
        "hourstar" => $key['hour_start'],
        "hourend" => $key['hour_end'],
        "color" => $key['color'],
        "textColor" => '#ffffff'
    );
}
$resEncodeA  = json_encode($arrayV);

//echo '<pre>';
echo $resEncodeA;
//echo '</pre>';